@extends('layout')

@section('title', 'DBF Viewer')
@section('page_desc', 'DBF Viewer by Riko Logwirno')

@section('main_content')

<div class="row">
    <div class="col-10 mx-auto" style="margin-bottom: 20px;">
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            Change DBF File : &nbsp;&nbsp;
            <input name="file" type="file" accept=".dbf" />
            <br>
            <input type="submit" value="Upload" />
        </form>
    </div>
    <div class="col-10 mx-auto table-responsive" style="margin-bottom: 60px;">

        <table id="table" class="table table-striped table-bordered hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    @foreach ($tableColumns as $kolom)
                        <th>{{ $kolom }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $max_row = $perPage;
                @endphp
                @while ($data = $datas->nextRecord())
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td scope="row">{{ $i+($perPage*($offset-1)) }}</td>
                        @foreach ($tableColumns as $kolom)
                            <td>{{ $data->$kolom }}</td>
                        @endforeach
                    </tr>
                    @php
                        if($i >= $max_row)
                        break;
                    @endphp
                @endwhile
            </tbody>
        </table>
        <div style="text-align: center;">
           {!! $links !!}
        </div>
        <p>
            Records Found: {{ $datas->recordCount }}
        </p>
        <p style="margin-top: 20px;">
            Elapsed Time:&nbsp;
            @php
                $elapsed = microtime(true) - $start_time;
                echo number_format((float) $elapsed, 8, '.', '');
            @endphp
            s
        </p>

    </div>
</div>

@endsection
