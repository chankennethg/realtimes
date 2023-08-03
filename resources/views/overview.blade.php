@extends('layouts.default')

@section('content')
    <h1 class="text-center mb-4">Football Player Stats</h1>
    <div class="container mt-5">
        <div class="row mb-1">
            <div class="col-md-3">
                <label for="year">Select Year:</label>
                <select id="year" class="form-select"></select>
            </div>

            <div class="col-md-3">
                <label for="statistic">Select Statistic:</label>
                <select id="statistic" class="form-select">
                    <option></option>
                </select>
            </div>
        </div>

    <table id="player-stats" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Player</th>
                <th>Statistic</th>
                <th>Value</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@push('scripts')
    @vite('resources/js/overview.js')
@endpush
