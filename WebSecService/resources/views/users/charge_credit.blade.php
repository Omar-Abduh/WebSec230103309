@extends('layouts.master')
@section('title', 'Charge Credit')
@section('content')
<div class="container mt-5">
    <h2>Charge Credit</h2>
    <form action="{{ route('users.charge.credit.save', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="credit_amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="credit_amount" placeholder="Enter Credit Amount" min="1" value="{{ $user->credit->credit_amount }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Charge Credit</button>
    </form>
</div>
@endsection