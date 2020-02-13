@extends('layouts.secured')

@section('title') Pages @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Homepage</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.pages.home')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Services</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.pages.services')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Contacts</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.pages.contacts')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Parts</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.pages.catalog', 'parts')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Equipment</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.pages.catalog', 'equipment')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
