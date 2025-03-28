<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DocumentArchiveRequest;
use App\Models\DocumentArchive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentArchivesController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability(['admin','supervisor'], 'manage_document_archives , show_document_archives')) {
            return redirect('admin/index');
        }


        $documentArchives = DocumentArchive::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderByRaw(request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
            ->paginate(\request()->limit_by ?? 100);


        return view('backend.document_archives.index', compact('documentArchives'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_document_archives')) {
            return redirect('admin/index');
        }
        return view('backend.document_archives.create');
    }

    public function store(DocumentArchiveRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_document_archives')) {
            return redirect('admin/index');
        }

        // dd($request->file('doc_archive_attached_file')->getMimeType());


        $data['doc_archive_name']          = $request->doc_archive_name;

        $data['status']                =   $request->status;
        $data['created_by']                = auth()->user()->full_name;

        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $data['published_on']            = $publishedOn;


        // Handle file uploads
        if ($file = $request->file('doc_archive_attached_file')) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('assets/document_archives');
            $file->move($filePath, $fileName); // Move image file
            $data['doc_archive_attached_file'] = $fileName;
        }

        $documentArchive = DocumentArchive::create($data);

        if ($documentArchive) {
            return redirect()->route('admin.document_archives.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.document_archives.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function edit($documentArchive)
    {
        if (!auth()->user()->ability('admin', 'update_document_archives')) {
            return redirect('admin/index');
        }

        $documentArchive = DocumentArchive::where('id', $documentArchive)->first();

        return view('backend.document_archives.edit', compact('documentArchive'));
    }


    public function update(DocumentArchiveRequest $request,  $documentArchive)
    {
        if (!auth()->user()->ability('admin', 'update_document_archives')) {
            return redirect('admin/index');
        }

        $documentArchive = DocumentArchive::where('id', $documentArchive)->first();




        // $data['doc_archive_name']           = $validatedData['doc_archive_name'];

        $data['doc_archive_name']           = $request->doc_archive_name;
        $data['status']                     = $request->status;
        $data['updated_by']                 = auth()->user()->full_name;

        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $data['published_on']            = $publishedOn;


        // remove the file if exist
        if (File::exists('assets/document_archives/' . $documentArchive->doc_archive_attached_file)) {
            unlink('assets/document_archives/' . $documentArchive->doc_archive_attached_file);
        }

        // Handle file uploads
        if ($file = $request->file('doc_archive_attached_file')) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('assets/document_archives');
            $file->move($filePath, $fileName); // Move image file
            $data['doc_archive_attached_file'] = $fileName;
        }

        $documentArchive->update($data);

        if ($documentArchive) {
            return redirect()->route('admin.document_archives.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.document_archives.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($documentArchive)
    {

        if (!auth()->user()->ability('admin', 'delete_document_archives')) {
            return redirect('admin/index');
        }

        $documentArchive = DocumentArchive::where('id', $documentArchive)->first();

        $documentArchive->deleted_by = auth()->user()->full_name;
        $documentArchive->save();
        $documentArchive->delete();

        if ($documentArchive) {
            return redirect()->route('admin.document_archives.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.document_archives.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function updateDocumentArchiveStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            DocumentArchive::where('id', $data['document_archive_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'document_archive_id' => $data['document_archive_id']]);
        }
    }
}
