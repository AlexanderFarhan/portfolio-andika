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
        $profile = \App\Models\Profile::first();
        return view('admin.messages.index', compact('messages', 'profile'));
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
