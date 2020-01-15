@extends('layouts.secured')

@section('content')
    <div id="refreshWrapper">
        <div class="row" id="figureConstructorWrapperTarget" data-figure="{{ $fig_id }}">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                    <p class="m-0">Figure</p>
                    <div style="display: inline-block; text-align: center; width: 100%;">
                        <div class="bd mt-20 mb-20 figure" style="position: relative; display: inline-block;">
                            <img src="{{ asset($figure->fig_image) }}" alt="{{ $pageTitle }}">
                            @foreach($nodes as $node)
                                @if($node->pos_x != 0 && $node->pos_y != 0)
                                    <div id="targetConstructorNode_{{ $node->id }}" style="position: absolute; top: {{ $node->pos_y - ($node->size_y / 2) }}px; left: {{ $node->pos_x - ($node->size_x / 2) }}px; border: 1px solid {{ $node->color }}; z-index: 9999; width: {{ $node->size_x }}px; height: {{ $node->size_y }}px;"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Products</h6>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Pos.No</th>
                            <th>Qty</th>
                            <th>Coordinates</th>
                            <th>Width (px)</th>
                            <th>Height (px)</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nodes as $node)
                            <tr>
                                <td style="color: {{ $node->color }} !important; font-weight: 600;">{{ $node->id }}</td>
                                <td>
                                    @if($node->has_photo != 0)
                                        <img src="{{ asset($node->thumb_path) }}" height="26" />
                                    @else
                                        <img src="{{ asset('assets/logos/logo.jpg') }}" height="26" />
                                    @endif
                                </td>
                                <td>{{ $node->n_name_en }} - {{ $node->fig_name_en }}</td>
                                <td>{{ $node->pos_no }}</td>
                                <td>{{ $node->qty }}</td>
                                <td>X:<span id="pos_x_{{ $node->id }}" data-target="pos_x">{{ $node->pos_x }}</span>; Y:<span id="pos_y_{{ $node->id }}" data-target="pos_y">{{ $node->pos_y }}</span></td>
                                <td><input type="text" name="size_x" value="{{ $node->size_x }}" style="max-width: 50px; text-align: center;"></td>
                                <td><input type="text" name="size_y" value="{{ $node->size_y }}" style="max-width: 50px; text-align: center;"></td>
                                <td
                                    data-color="{{ $node->color }}"
                                    data-id="{{ $node->id }}"
                                >
                                    <a href="#" id="editNodePositionConstructor" style="font-size: 16px; padding: 5px;"><i class="c-blue-500 ti-pencil"></i></a>
                                    <a href="#" id="saveNodePositionConstructor" style="font-size: 16px; padding: 5px;"><i class="c-green-500 ti-save"></i></a>
                                    <a href="#" id="removeNodePositionConstructor" style="font-size: 16px; padding: 5px;"><i class="c-red-500 ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
