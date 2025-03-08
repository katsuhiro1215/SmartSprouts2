<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        $allContacts = Contact::select('id', 'subject', 'created_at')->latest()->paginate(20);
        $contacts = Contact::withoutTrashed('id', 'subject', 'created_at')->latest()->paginate(20);
        $deletedContacts = Contact::onlyTrashed()->select('id','id', 'subject', 'created_at')->get();

        return Inertia::render('Admin/Contacts/Index', [
            'allContacts' => $allContacts,
            'contacts' => $contacts,
            'deletedContacts' => $deletedContacts,
        ]);
    }

    public function show(Contact $contact)
    {
        $contacts = Contact::all();
        if ($contact->status === '未読') {
            $contact->update(['status' => '既読']);
        }

        return Inertia::render('Admin/Contacts/Show', [
            'contact' => $contact,
            'contacts' => $contacts,
        ]);
    }

    public function edit(Contact $contact)
    {
        return Inertia::render('Admin/Contacts/Edit', [
            'contact' => $contact,
        ]);
    }

    public function restore($id)
    {
        Contact::onlyTrashed()->find($id)->restore();

        return to_route('admin.contact.index')->with([
            'success' => 'お問い合わせを復元しました。',
            'status' => 'success',
        ]);
    }

    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->find($id);
        $contact->forceDelete();

        return redirect()->route('admin.contact.index')->with([
            'success' => 'お問い合わせを完全削除しました。',
            'status' => 'success',
        ]);
    }
}
