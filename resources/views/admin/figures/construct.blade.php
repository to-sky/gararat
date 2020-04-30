@extends('admin.layouts.master')

@section('title') Figure: {{ $figure->catalog()->first()->cat_name_en }} @endsection

@section('content')
    <div id="refreshWrapper">
        <div class="row" id="figureConstructorWrapperTarget" data-figure="{{ $figure->fig_id }}">
            <div class="col-12">
                <div class="text-center bg-white bd">
                    <div class="figure" style="position: relative; display: inline-block;">
                        <img src="{{ asset($figure->fig_image) }}" alt="{{ $figure->catalog()->first()->cat_name_en }}">
                        @foreach($figure->nodes as $node)
                            @if($node->pivot->pos_x && $node->pivot->pos_y)
                                <div id="targetConstructorNode_{{ $node->id }}"
                                     style="position: absolute;
                                             top: {{ $node->pivot->pos_y - ($node->pivot->size_y / 2) }}px;
                                             left: {{ $node->pivot->pos_x - ($node->pivot->size_x / 2) }}px;
                                             border: 1px solid {{ $node->pivot->color }};
                                             z-index: 700;
                                             width: {{ $node->pivot->size_x }}px;
                                             height: {{ $node->pivot->size_y }}px;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Products tabs --}}
        <ul class="nav nav-tabs mt-4" id="productsTab" role="tablist">
            <li class="nav-item bg-white">
                <a class="nav-link bg-white active" id="inTheDraw-tab" data-toggle="tab" href="#inTheDrawTab" role="tab" aria-controls="inTheDraw" aria-selected="true">
                    Displayed products on the image <span class="badge badge-pill border pt-1 text-black-50">{{ count($separatedNodesParts['inTheDraw']) }}</span>
                </a>
            </li>
            <li class="nav-item bg-white">
                <a class="nav-link bg-white" id="notIneTheDraw-tab" data-toggle="tab" href="#notInTheDrawTab" role="tab" aria-controls="notIneTheDraw" aria-selected="false">
                    Not displayed products on the image <span class="badge badge-pill border pt-1 text-black-50">{{ count($separatedNodesParts['notInTheDraw']) }}</span>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="productsTab">
            <div class="tab-pane fade show active" id="inTheDrawTab" role="tabpanel" aria-labelledby="inTheDraw-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="bgc-white bd">
                            <table class="table table-borderless table-hover table-striped">
                                <thead class="shadow-sm">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Position</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Coordinates</th>
                                        <th>Width (px)</th>
                                        <th>Height (px)</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($separatedNodesParts['inTheDraw'] as $node)
                                    <tr>
                                        <td>{{ $node->id }}</td>
                                        <td class="text-center font-weight-bold" style="color: {{ $node->pivot->color }} !important;">
                                            {{ $node->part->pos_no }}
                                        </td>
                                        <td>
                                            <img src="{{ asset($node->getImageOrEmpty()) }}" height="26" alt="{{ $node->n_name_en }}"/>
                                        </td>
                                        <td>{{ $node->n_name_en }}</td>
                                        <td>{{ $node->part->qty }}</td>
                                        <td>
                                            X:<span id="pos_x_{{ $node->id }}" data-target="pos_x">{{ $node->pivot->pos_x }}</span>;
                                            Y:<span id="pos_y_{{ $node->id }}" data-target="pos_y">{{ $node->pivot->pos_y }}</span>
                                        </td>
                                        <td>
                                            <input type="text" name="size_x" value="{{ $node->pivot->size_x }}" class="text-center" style="max-width: 50px;">
                                        </td>
                                        <td>
                                            <input type="text" name="size_y" value="{{ $node->pivot->size_y }}" class="text-center" style="max-width: 50px;">
                                        </td>
                                        <td data-color="{{ $node->pivot->color }}" data-id="{{ $node->id }}" data-position="{{ $node->part->pos_no }}">
                                            <div class="float-right">
                                                <a href="#" class="editNodePositionConstructor fsz-def p-5"><i class="c-blue-500 ti-pencil"></i></a>
                                                <a href="#" class="saveNodePositionConstructor fsz-def p-5"><i class="c-green-500 ti-save"></i></a>
                                                <a href="#" class="removeNodePositionConstructor fsz-def p-5"><i class="c-red-500 ti-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="notInTheDrawTab" role="tabpanel" aria-labelledby="notInTheDrawTab-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="bgc-white bd">
                            <table class="table table-borderless table-hover table-striped">
                                <thead class="shadow-sm">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Coordinates</th>
                                        <th>Width (px)</th>
                                        <th>Height (px)</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($separatedNodesParts['notInTheDraw'] as $node)
                                    <tr>
                                        <td>{{ $node->id }}</td>
                                        <td>
                                            <img src="{{ asset($node->getImageOrEmpty()) }}" height="26" alt="{{ $node->n_name_en }}"/>
                                        </td>
                                        <td>{{ $node->n_name_en }}</td>
                                        <td>{{ $node->part->qty }}</td>
                                        <td>
                                            X:<span id="pos_x_{{ $node->id }}" data-target="pos_x">{{ $node->pivot->pos_x }}</span>;
                                            Y:<span id="pos_y_{{ $node->id }}" data-target="pos_y">{{ $node->pivot->pos_y }}</span>
                                        </td>
                                        <td>
                                            <input type="text" name="size_x" value="{{ $node->pivot->size_x }}" class="text-center" style="max-width: 50px;">
                                        </td>
                                        <td>
                                            <input type="text" name="size_y" value="{{ $node->pivot->size_y }}" class="text-center" style="max-width: 50px;">
                                        </td>
                                        <td data-color="{{ $node->pivot->color }}" data-id="{{ $node->id }}" data-position="{{ $node->part->pos_no }}">
                                            <div class="float-right">
                                                <a href="#" class="editNodePositionConstructor fsz-def p-5"><i class="c-blue-500 ti-pencil"></i></a>
                                                <a href="#" class="saveNodePositionConstructor fsz-def p-5"><i class="c-green-500 ti-save"></i></a>
                                                <a href="#" class="removeNodePositionConstructor fsz-def p-5"><i class="c-red-500 ti-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
