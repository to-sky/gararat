@extends('admin.layouts.master')

@section('title', 'Pages')

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
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.pages.home')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Services</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.pages.services')
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Contacts</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.pages.contacts')
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
