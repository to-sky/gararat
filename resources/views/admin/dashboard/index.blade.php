@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="masonry-item w-100">
                <div class="row gap-20">

                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Total Parts</h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">
                                            {{ count($parts) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Total Equipment</h6>
                            </div>
                            <div class="layer w-100">

                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">
                                            {{ count($equipment) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10"><h6 class="lh-1">Total Orders</h6></div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-purple-50 c-purple-500">
                                            {{ count($orders) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="layers bd bgc-white p-20">
                            <div class="layer w-100 mB-10"><h6 class="lh-1">Total Subscribers</h6></div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <div class="peer">
                                        <span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-blue-50 c-blue-500">
                                            {{ count($subscribers) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-4">
                <h4>Backups</h4>
                <div class="card rounded-0 border">
                    <div class="card-body p-0">
                        @if($backupFiles)
                        <table class="table table-borderless table-striped">
                            <thead class="text-black-50 shadow-sm">
                                <tr>
                                    <th>№</th>
                                    <th>File</th>
                                    <th width="20%" class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($backupFiles as $backupFile)
                                <tr class="border-top">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong class="text-muted">{{ $backupFile->getFilename() }}</strong>
                                        <small class="ml-2 border rounded border-muted p-3 text-muted">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d-H-i-s', $backupFile->getFilenameWithoutExtension())->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td class="float-right">
                                        <a href="{{ route('admin.download.backup', [
                                            'pathToFile' => $backupFile->getRealPath()
                                        ]) }}" class="btn btn-sm btn-outline-success bg-white text-success"><i class="fas fa-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <p class="m-15">Backups not found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
