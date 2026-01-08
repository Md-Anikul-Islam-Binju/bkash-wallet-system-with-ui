

<x-app-layout>
    <div class="container py-5">

        <!-- Page Title -->
        <h2 class="mb-4 text-center text-dark bg-primary py-3 rounded shadow-sm">
            bKash Wallet
        </h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(!$wallet)
            <!-- Connect Wallet Button -->
            <div class="text-center mt-5">
                <form method="POST" action="/wallet/connect">
                    @csrf
                    <button class="btn btn-danger btn-lg shadow-lg">
                        <i class="bi bi-wallet2 me-2"></i> Connect bKash
                    </button>
                </form>
            </div>
        @else
            <div class="row g-4 mt-3">

                <!-- Wallet Balance Card -->
                <div class="col-md-4">
                    <div class="card text-center shadow-lg border-0 rounded-3" style="background: linear-gradient(135deg, #ff5858, #f09819); color: #fff;">
                        <div class="card-body">
                            <h5 class="card-title text-light">Wallet Balance</h5>
                            <p class="card-text display-5 fw-bold">৳ {{ $wallet->balance }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Form Card -->
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-3" style="background: #e0f7fa;">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">Make a Payment</h5>
                            <form method="POST" action="/wallet/pay" class="row g-2">
                                @csrf
                                <div class="col-sm-6">
                                    <input type="number" name="amount" class="form-control form-control-lg" placeholder="Enter Amount" min="1" required>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">
                                        <i class="bi bi-cash-stack me-2"></i> Pay Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="card mt-4 shadow-lg border-0 rounded-3" style="background: #f3e5f5;">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-purple fw-bold">Recent Transactions</h5>
                    @if(count($transactions) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead style="background: #9c27b0; color: #fff;">
                                <tr>
                                    <th>TRX ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $tx)
                                    <tr>
                                        <td>{{ $tx->trx_id }}</td>
                                        <td>৳ {{ $tx->amount }}</td>
                                        <td>
                                            @if($tx->status === 'success')
                                                <span class="badge bg-success">Success</span>
                                            @elseif($tx->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No transactions yet.</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
