 <!--
        <div class="table-responsive table-striped mb-2">
            <table class="table m-b-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Tampil</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Opacity</th>
                        <th colspan="3" class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ $value->category_name}}</td>
                        <td>{{ $value->display == 1 ? 'Ya' :'Tidak'}}</td>
                        <td><button type="button" class="btn " style="background-color: {{ $value->fill_color}};color: #ffffff">{{ $value->fill_color}}</button></td>
                        <td>{{ $value->fill_opacity}}</td>
                        <td><a href="{{ route('geojson.show',$value->category_id) }}" class="btn btn-primary btn-icon btn-circle btn-md"><i class="fa fa-search-plus "></i></a></td>
                        <td><a href="{{ route('geojson.edit',$value->category_id) }}" class="btn btn-warning btn-icon btn-circle btn-md"><i class="fa fa-edit "></i></a></td>
                        <td><a href="javascript:;" data-id="{{$value->category_id}}" data-name="{{ $value->category_name}}" class="btn btn-danger btn-icon btn-circle btn-md btnDelete"><i class="fa fa-trash "></i></a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        {{ $data->links() }}-->

        
        <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Tampil</label>
                <div class="col-md-9">
                    <select class="form-control" name="display">
                        <option value="1" >Ya</option>
                        <option value="0" >Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Color</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input class="form-control" name="fill_color" data-id="color-palette-1" value="{{ old('fill_color') }}"/>
                        <div class="input-group-append">
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <div id="color-palette-1"></div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary text-white" data-toggle="dropdown"><i class="fa fa-tint fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Opacity</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="" name="fill_opacity" value="{{ old('fill_opacity') }}">
                </div>
            </div>
          