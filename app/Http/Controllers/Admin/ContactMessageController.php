<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('id', 'desc')->paginate(15);
        $readCount = ContactMessage::where('is_read', true)->count();
        $unreadCount = ContactMessage::where('is_read', false)->count();
        $profile = \App\Models\Profile::first();
        return view('admin.messages.index', compact('messages', 'profile', 'readCount', 'unreadCount'));
    }

    public function show(ContactMessage $message)
    {
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan kontak berhasil dihapus.');
    }

    /**
     * Delete all messages that have already been marked as read.
     */
    public function destroyRead()
    {
        $count = ContactMessage::where('is_read', true)->delete();

        if ($count === 0) {
            return redirect()->route('admin.messages.index')
                ->with('error', 'Tidak ada pesan berstatus sudah dibaca yang dapat dihapus.');
        }

        return redirect()->route('admin.messages.index')
            ->with('success', "Berhasil menghapus {$count} pesan yang sudah dibaca.");
    }

    /**
     * Delete multiple selected messages at once.
     */
    public function destroyBatch(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.messages.index')
                ->with('error', 'Tidak ada pesan yang dipilih untuk dihapus.');
        }

        $count = ContactMessage::whereIn('id', $ids)->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', "Berhasil menghapus {$count} pesan terpilih.");
    }

    /**
     * Realtime polling endpoint for live admin message updates.
     */
    public function poll(Request $request)
    {
        $afterId = (int) $request->query('after_id', 0);

        $newMessages = ContactMessage::where('id', '>', $afterId)
            ->orderBy('id', 'asc')
            ->get();

        $unreadCount = ContactMessage::where('is_read', false)->count();
        $totalCount = ContactMessage::count();
        $latestId = (int) (ContactMessage::max('id') ?? $afterId);

        return response()->json([
            'new_messages' => $newMessages->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'name' => $msg->name,
                    'email' => $msg->email,
                    'phone' => $msg->phone,
                    'subject' => $msg->subject,
                    'message' => $msg->message,
                    'created_at_human' => $msg->created_at ? $msg->created_at->diffForHumans() : 'baru saja',
                    'created_at_formatted' => $msg->created_at ? $msg->created_at->format('d M Y, H:i') : '',
                    'show_url' => route('admin.messages.show', $msg->id),
                    'is_read' => (bool) $msg->is_read,
                ];
            }),
            'unread_count' => $unreadCount,
            'total_count' => $totalCount,
            'latest_id' => (int) $latestId,
            'has_new' => $newMessages->count() > 0,
        ]);
    }
}
