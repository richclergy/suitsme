@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h1 class="text-center font-bold mb-4">UPLOAD TRANSACTION</h1>
            @if (session()->has('status'))            
                <div class="bg-red-500 p-4 rounded-lg mb-6 mt-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="txn" class="sr-only">Transaction File:</label>
                    <input type="file" name="txn" id="txn" placeholder="Upload file" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('txn') border-red-500 @enderror"  value="{{ old('txn') }}">
                    @error('txn')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Submit Transaction</button>
                </div>
            </form>
        </div>
    </div>
@endsection