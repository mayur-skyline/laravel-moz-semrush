@extends("layouts.master")

@section("title","Moz")

@section("content")
<div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Moz Global Top Domains</h1>
        @if(!empty($response))
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="py-2 px-4">Moz Rank</th>
                            <th class="py-2 px-4">Root Domain</th>
                            <th class="py-2 px-4">Root Domains to Root Domain</th>
                            <th class="py-2 px-4">Domain Authority</th>
                            <th class="py-2 px-4">Link Propensity</th>
                            <th class="py-2 px-4">Spam Score</th>
                            <!-- Add more columns based on your response structure -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($response as $result)
                            <tr>
                                <td class="py-2 px-4">{{ $result['moz_rank'] ?? ''}}</td>
                                <td class="py-2 px-4">{{ $result['root_domain'] ?? ''}}</td>
                                <td class="py-2 px-4">{{ $result['root_domains_to_root_domain'] ?? ''}}</td>
                                <td class="py-2 px-4">{{ $result['domain_authority'] ?? ''}}</td>
                                <td class="py-2 px-4">{{ $result['link_propensity'] ?? ''}}</td>
                                <td class="py-2 px-4">{{ $result['spam_score'] ?? ''}}</td>
                                <!-- Add more cells based on your response structure -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-700">No data available.</p>
        @endif
    </div>
@endsection
