@extends("layouts.master")

@section("title","Moz")

@section("content")
<h1 class="font-bold mb-6 text-center">SEMrush Data</h1>

    @if (!empty($response))
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach($response[0] as $key => $value)
                            <th class="py-2 px-4">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
            <tbody>
                @foreach($response as $row)
                    <tr>
                        @foreach($row as $value)
                            <td class="py-2 px-4">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-700">No data available.</p>
    @endif
@endsection
