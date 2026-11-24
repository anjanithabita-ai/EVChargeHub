
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Pembayaran & Refund | EVChargeHub</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f4f7f6;color:#263238}

.sidebar{width:250px;height:100vh;position:fixed;top:0;left:0;background:#00695c;color:white;overflow-y:auto;padding-bottom:20px;z-index:100}
.brand{display:flex;align-items:center;gap:14px;padding:15px 23px;height:85px;font-size:22px;font-weight:800;border-bottom:1px solid #ffffff20}
.brand-icon{width:45px;height:45px;border-radius:50%;background:#20d890;display:flex;align-items:center;justify-content:center;font-size:24px}
.menu-label{padding:23px 25px 9px;font-size:11px;font-weight:700;letter-spacing:1.5px;color:#ffffffbf}
.menu-item,.menu-item-disabled{display:flex;align-items:center;gap:15px;margin:3px 20px 3px 12px;padding:14px 15px;border-radius:9px;color:white;text-decoration:none;font-size:13px}
.menu-item i,.menu-item-disabled i{width:22px;text-align:center}
.menu-item:hover{background:#ffffff18}
.menu-item.active{background:#10aa79;border-left:4px solid #20d890;font-weight:700;padding-left:11px}
.logout{margin-top:25px;border-top:1px solid #ffffff25;padding-top:12px}
.logout button{width:100%;border:0;background:transparent;color:white;text-align:left;cursor:pointer}

.main-content{margin-left:250px;padding:30px;min-height:100vh}
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:25px;gap:15px}
h1{font-size:25px;margin-bottom:7px}
.subtitle{font-size:13px;color:#78909c;line-height:1.5}
.admin-info{display:flex;align-items:center;gap:10px;font-size:13px;font-weight:600}
.admin-avatar{width:38px;height:38px;border-radius:50%;background:#d1fae5;color:#00695c;display:flex;align-items:center;justify-content:center}

.alert{padding:13px 16px;border-radius:8px;margin-bottom:18px;font-size:13px}
.alert-success{background:#d1fae5;color:#065f46}
.alert-error{background:#fee2e2;color:#991b1b}

.info-box{display:flex;gap:13px;align-items:flex-start;background:#effaf5;border:1px solid #ccefe0;padding:16px 18px;border-radius:10px;margin-bottom:22px}
.info-icon{width:38px;height:38px;flex-shrink:0;background:#d1fae5;color:#059669;border-radius:9px;display:flex;align-items:center;justify-content:center}
.info-box strong{font-size:13px;color:#065f46;display:block;margin-bottom:5px}
.info-box p{font-size:12px;color:#52756a;line-height:1.6}

.summary-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:15px;margin-bottom:22px}
.summary-card,.content-card{background:white;border-radius:12px;padding:20px;border:1px solid #edf1f0;box-shadow:0 2px 10px #00000006}
.summary-icon{width:40px;height:40px;border-radius:10px;background:#d1fae5;color:#059669;display:flex;align-items:center;justify-content:center;margin-bottom:13px}
.warning-icon{background:#fef3c7;color:#b45309}
.purple-icon{background:#ede9fe;color:#6d28d9}
.blue-icon{background:#e0f2fe;color:#0284c7}
.summary-label{font-size:12px;color:#78909c;margin-bottom:9px}
.summary-card h2{font-size:21px}
.summary-card small{display:block;color:#90a4ae;margin-top:7px;font-size:11px}

.card-header{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;margin-bottom:18px}
.card-header h3{font-size:17px}
.card-description{font-size:12px;color:#90a4ae;margin-top:6px}
.filter-form{display:flex;gap:9px;flex-wrap:wrap}
.filter-form input,.filter-form select{padding:10px 12px;border:1px solid #dce5e2;border-radius:7px;font-size:12px;outline:none}
.filter-form input:focus,.filter-form select:focus{border-color:#10aa79}

.btn{padding:9px 12px;border:0;border-radius:7px;cursor:pointer;font-size:12px;font-weight:600;display:inline-flex;align-items:center;justify-content:center;gap:6px;text-decoration:none;white-space:nowrap}
.btn-primary{background:#10aa79;color:white}
.btn-primary:hover{background:#078b63}
.btn-detail{background:#e0f2fe;color:#0369a1}
.btn-refund{background:#fee2e2;color:#dc2626}
.btn-refund:hover{background:#fecaca}
.btn-disabled{background:#e5e7eb;color:#9ca3af;cursor:not-allowed}

.table-wrapper{overflow-x:auto}
table{width:100%;border-collapse:collapse;min-width:1050px}
th{background:#f8faf9;color:#78909c;font-size:11px;text-align:left;padding:14px 12px;white-space:nowrap}
td{padding:14px 12px;border-bottom:1px solid #edf1f0;font-size:12px;vertical-align:middle}
tbody tr:hover{background:#fbfdfc}
.user-name{font-weight:600;margin-bottom:4px}
.user-email{font-size:11px;color:#90a4ae}
.status,.duplicate-badge{display:inline-block;padding:6px 9px;border-radius:20px;font-size:10px;font-weight:700}
.status-berhasil{background:#d1fae5;color:#047857}
.status-pending{background:#fef3c7;color:#b45309}
.status-gagal{background:#fee2e2;color:#dc2626}
.status-refund{background:#ede9fe;color:#6d28d9}
.duplicate-badge{background:#fff1d6;color:#a16207;margin-top:5px}
.main-payment-badge{background:#e0f2fe;color:#0369a1;margin-top:5px}
.action-buttons{display:flex;gap:6px;align-items:center}
.pagination{margin-top:20px}

.modal{display:none;position:fixed;inset:0;background:#0007;z-index:999;align-items:center;justify-content:center;padding:20px}
.modal.show{display:flex}
.modal-content{width:100%;max-width:470px;background:white;border-radius:13px;padding:25px;max-height:90vh;overflow-y:auto}
.modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
.modal-header h3{font-size:18px}
.close-modal{border:0;background:none;font-size:23px;cursor:pointer;color:#78909c}
.detail-row{display:flex;justify-content:space-between;gap:15px;padding:12px 0;border-bottom:1px solid #edf1f0;font-size:12px}
.detail-row span:first-child{color:#78909c}
.detail-row span:last-child{text-align:right;font-weight:600}
.warning-box{padding:14px;background:#fff7ed;color:#9a3412;border:1px solid #fed7aa;border-radius:8px;font-size:12px;line-height:1.6;margin-bottom:17px}
.modal-footer{display:flex;justify-content:flex-end;gap:9px;margin-top:20px}
.checkbox-row{display:flex;gap:9px;font-size:12px;line-height:1.5}

@media(max-width:1100px){.summary-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:650px){
    .sidebar{width:65px}
    .brand{justify-content:center;padding:10px}
    .brand span,.menu-label,.menu-item span,.menu-item-disabled span{display:none}
    .menu-item,.menu-item-disabled{justify-content:center;margin:5px;padding:13px 5px}
    .main-content{margin-left:65px;padding:18px 12px}
    .summary-grid{grid-template-columns:1fr}
    .topbar{align-items:flex-start;flex-direction:column}
}
</style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">⚡</div>
        <span>EVChargeHub</span>
    </div>

    <div class="menu-label">MENU UTAMA</div>
    <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard')?'active':'' }}">
        <i>🏠</i><span>Dashboard</span>
    </a>

    <div class="menu-label">MANAJEMEN</div>
    <div class="menu-item-disabled"><i>👥</i><span>Kelola Pengguna</span></div>
    <div class="menu-item-disabled"><i>👨‍💼</i><span>Kelola Operator</span></div>

    <a href="{{ route('admin.charging-stations.index') }}" class="menu-item {{ request()->routeIs('admin.charging-stations.*')?'active':'' }}">
        <i>📍</i><span>Charging Station</span>
    </a>
    <a href="{{ route('admin.chargers.index') }}" class="menu-item {{ request()->routeIs('admin.chargers.*')?'active':'' }}">
        <i>🔌</i><span>Kelola Charger</span>
    </a>

    <div class="menu-label">OPERASIONAL</div>
    <a href="{{ route('admin.monitoring.index') }}" class="menu-item {{ request()->routeIs('admin.monitoring.*')?'active':'' }}">
        <i>⚡</i><span>Monitoring Charging</span>
    </a>

    <div class="menu-label">LAPORAN & TRANSAKSI</div>
    <a href="{{ route('admin.reports.index') }}" class="menu-item {{ request()->routeIs('admin.reports.*')?'active':'' }}">
        <i>📊</i><span>Laporan</span>
    </a>
    <a href="{{ route('admin.tariffs.index') }}" class="menu-item {{ request()->routeIs('admin.tariffs.*')?'active':'' }}">
        <i>💰</i><span>Tarif per Station</span>
    </a>
    <a href="{{ route('admin.payments.index') }}" class="menu-item active">
        <i>💳</i><span>Kelola Pembayaran & Refund</span>
    </a>

    <div class="menu-label">KOMUNIKASI</div>
    <div class="menu-item-disabled"><i>⭐</i><span>Ulasan & Feedback</span></div>
    <div class="menu-item-disabled"><i>📢</i><span>Promosi</span></div>

    <div class="menu-label">SISTEM</div>
    <div class="menu-item-disabled"><i>🛡️</i><span>Hak Akses</span></div>
    <div class="menu-item-disabled"><i>🕘</i><span>Audit Log</span></div>

    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="menu-item" type="submit">
                <i>🚪</i><span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<main class="main-content">

    <div class="topbar">
        <div>
            <h1>Kelola Pembayaran & Refund</h1>
            <p class="subtitle">
                Monitor transaksi pembayaran dan kelola pengembalian dana untuk transaksi pembayaran ganda.
            </p>
        </div>

        <div class="admin-info">
            <div class="admin-avatar"><i class="fa-solid fa-user-shield"></i></div>
            {{ auth()->user()->nama ?? auth()->user()->name ?? 'Admin' }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div class="info-box">
        <div class="info-icon"><i class="fa-solid fa-circle-info"></i></div>
        <div>
            <strong>Informasi Pembayaran dan Refund</strong>
            <p>
                Refund hanya tersedia untuk pembayaran tambahan yang terindikasi tercatat
                lebih dari satu kali pada sesi yang sama. Pembayaran utama yang berhasil
                tidak dapat direfund melalui halaman ini.
            </p>
        </div>
    </div>

    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div class="summary-label">Total Pembayaran Berhasil</div>
            <h2>Rp {{ number_format($totalNominal ?? 0,0,',','.') }}</h2>
            <small>Akumulasi nominal pembayaran berhasil</small>
        </div>

        <div class="summary-card">
            <div class="summary-icon blue-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="summary-label">Total Transaksi</div>
            <h2>{{ number_format($totalTransaksi ?? 0,0,',','.') }}</h2>
            <small>Seluruh transaksi pembayaran</small>
        </div>

        <div class="summary-card">
            <div class="summary-icon warning-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="summary-label">Pembayaran Ganda</div>
            <h2>{{ number_format($totalPerluPemeriksaan ?? 0,0,',','.') }}</h2>
            <small>Transaksi tambahan yang perlu diperiksa</small>
        </div>

        <div class="summary-card">
            <div class="summary-icon purple-icon">
                <i class="fa-solid fa-rotate-left"></i>
            </div>
            <div class="summary-label">Total Refund</div>
            <h2>{{ number_format($totalRefund ?? 0,0,',','.') }}</h2>
            <small>Nominal: Rp {{ number_format($nominalRefund ?? 0,0,',','.') }}</small>
        </div>

    </div>

    <div class="content-card">

        <div class="card-header">
            <div>
                <h3><i class="fa-solid fa-list"></i> Data Pembayaran Pengguna</h3>
                <p class="card-description">
                    Periksa riwayat pembayaran dan identifikasi transaksi yang terduplikasi.
                </p>
            </div>

            <form action="{{ route('admin.payments.index') }}" method="GET" class="filter-form">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari ID, nama, email..."
                    value="{{ $search ?? '' }}"
                >

                <select name="status">
                    <option value="">Semua Status</option>
                    @foreach(['berhasil'=>'Berhasil','pending'=>'Pending','gagal'=>'Gagal','refund'=>'Refund'] as $key=>$label)
                        <option value="{{ $key }}" {{ ($filterStatus ?? '')==$key?'selected':'' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-search"></i> Cari
                </button>

                <a href="{{ route('admin.payments.index') }}" class="btn btn-disabled">
                    Reset
                </a>
            </form>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID TRANSAKSI</th>
                        <th>PENGGUNA</th>
                        <th>ID SESI</th>
                        <th>JUMLAH</th>
                        <th>METODE</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($payments as $payment)
                    @php
                        $status = strtolower($payment->status ?? '');
                        $tanggal = $payment->waktu_pembayaran ?? $payment->created_at;

                        $statusClass = match($status) {
                            'berhasil' => 'status-berhasil',
                            'pending' => 'status-pending',
                            'gagal' => 'status-gagal',
                            'refund' => 'status-refund',
                            default => 'status-pending'
                        };

                        $isDuplicate = (bool) ($payment->indikasi_duplikat ?? false);
                    @endphp

                    <tr>
                        <td><strong>#{{ $payment->id_payment }}</strong></td>

                        <td>
                            <div class="user-name">{{ $payment->nama_user ?? 'Pengguna' }}</div>
                            <div class="user-email">{{ $payment->email_user ?? '-' }}</div>
                        </td>

                        <td>{{ $payment->id_session ?? '-' }}</td>

                        <td>
                            <strong>Rp {{ number_format($payment->jumlah ?? 0,0,',','.') }}</strong>
                        </td>

                        <td>{{ ucfirst($payment->metode ?? '-') }}</td>

                        <td>
                            {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d/m/Y H:i') : '-' }}
                        </td>

                        <td>
                            <span class="status {{ $statusClass }}">
                                {{ ucfirst($payment->status ?? '-') }}
                            </span>

                            @if($status === 'berhasil' && $isDuplicate)
                                <br>
                                <span class="duplicate-badge">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Pembayaran ganda
                                </span>
                            @elseif($status === 'berhasil')
                                <br>
                                <span class="main-payment-badge">
                                    <i class="fa-solid fa-check"></i>
                                    Pembayaran utama
                                </span>
                            @elseif($status === 'refund')
                                <br>
                                <span class="duplicate-badge">
                                    <i class="fa-solid fa-check-circle"></i>
                                    Refund diproses
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons">

                                <button
                                    class="btn btn-detail"
                                    type="button"
                                    onclick="showDetail(this)"
                                    data-id="{{ $payment->id_payment }}"
                                    data-session="{{ $payment->id_session ?? '-' }}"
                                    data-user="{{ $payment->nama_user ?? 'Pengguna' }}"
                                    data-email="{{ $payment->email_user ?? '-' }}"
                                    data-jumlah="{{ number_format($payment->jumlah ?? 0,0,',','.') }}"
                                    data-metode="{{ ucfirst($payment->metode ?? '-') }}"
                                    data-tanggal="{{ $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d/m/Y H:i') : '-' }}"
                                    data-status="{{ ucfirst($payment->status ?? '-') }}"
                                    data-referensi="{{ $payment->referensi_gateway ?? '-' }}"
                                    data-keterangan="{{ $isDuplicate ? 'Pembayaran tambahan / terindikasi ganda' : 'Pembayaran utama atau tidak terindikasi ganda' }}"
                                >
                                    <i class="fa-solid fa-eye"></i> Detail
                                </button>

                                @if($status === 'refund')
                                    <button class="btn btn-disabled" type="button" disabled>
                                        <i class="fa-solid fa-check"></i> Sudah Refund
                                    </button>

                                @elseif($status === 'berhasil' && $isDuplicate)
                                    <button
                                        class="btn btn-refund"
                                        type="button"
                                        onclick="showRefund(
                                            '{{ $payment->id_payment }}',
                                            '{{ number_format($payment->jumlah ?? 0,0,',','.') }}'
                                        )"
                                    >
                                        <i class="fa-solid fa-rotate-left"></i> Refund
                                    </button>

                                @else
                                    <button class="btn btn-disabled" type="button" disabled>
                                        <i class="fa-solid fa-lock"></i> Tidak Tersedia
                                    </button>
                                @endif

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:35px;color:#90a4ae">
                            Belum ada transaksi pembayaran.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $payments->links() }}
        </div>

    </div>
</main>

<!-- MODAL DETAIL -->
<div class="modal" id="detailModal">
    <div class="modal-content">

        <div class="modal-header">
            <h3>Detail Transaksi</h3>
            <button class="close-modal" onclick="closeModal('detailModal')">&times;</button>
        </div>

        <div class="detail-row"><span>ID Transaksi</span><span id="detail-id">-</span></div>
        <div class="detail-row"><span>ID Sesi</span><span id="detail-session">-</span></div>
        <div class="detail-row"><span>Pengguna</span><span id="detail-user">-</span></div>
        <div class="detail-row"><span>Email</span><span id="detail-email">-</span></div>
        <div class="detail-row"><span>Jumlah</span><span id="detail-jumlah">-</span></div>
        <div class="detail-row"><span>Metode</span><span id="detail-metode">-</span></div>
        <div class="detail-row"><span>Tanggal</span><span id="detail-tanggal">-</span></div>
        <div class="detail-row"><span>Status</span><span id="detail-status">-</span></div>
        <div class="detail-row"><span>Referensi Gateway</span><span id="detail-referensi">-</span></div>
        <div class="detail-row"><span>Keterangan</span><span id="detail-keterangan">-</span></div>

        <div class="modal-footer">
            <button class="btn btn-primary" onclick="closeModal('detailModal')">Tutup</button>
        </div>

    </div>
</div>

<!-- MODAL REFUND -->
<div class="modal" id="refundModal">
    <div class="modal-content">

        <div class="modal-header">
            <h3>Konfirmasi Refund</h3>
            <button class="close-modal" onclick="closeModal('refundModal')">&times;</button>
        </div>

        <div class="warning-box">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <strong>Transaksi terindikasi pembayaran ganda.</strong><br>
            Pastikan transaksi ini merupakan pembayaran tambahan,
            bukan pembayaran utama pengguna. Refund hanya dapat diproses
            untuk transaksi tambahan yang telah diperiksa.
        </div>

        <div class="detail-row">
            <span>ID Transaksi</span>
            <strong id="refund-id">-</strong>
        </div>

        <div class="detail-row">
            <span>Nominal</span>
            <strong id="refund-amount">-</strong>
        </div>

        <div class="detail-row">
            <span>Tujuan refund</span>
            <strong>Wallet pengguna</strong>
        </div>

        <form id="refundForm" method="POST">
            @csrf

            <label class="checkbox-row" style="margin-top:18px">
                <input type="checkbox" name="konfirmasi" value="1" required>
                <span>
                    Saya sudah memeriksa transaksi dan menyetujui refund
                    untuk pembayaran tambahan ini.
                </span>
            </label>

            <div class="modal-footer">
                <button type="button" class="btn btn-disabled" onclick="closeModal('refundModal')">
                    Batal
                </button>

                <button type="submit" class="btn btn-refund">
                    <i class="fa-solid fa-rotate-left"></i> Konfirmasi Refund
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function showDetail(button) {
    const fields = [
        'id',
        'session',
        'user',
        'email',
        'jumlah',
        'metode',
        'tanggal',
        'status',
        'referensi',
        'keterangan'
    ];

    fields.forEach(field => {
        document.getElementById('detail-' + field).textContent =
            button.dataset[field] || '-';
    });

    document.getElementById('detailModal').classList.add('show');
}

function showRefund(id, amount) {
    document.getElementById('refund-id').textContent = '#' + id;
    document.getElementById('refund-amount').textContent = 'Rp ' + amount;

    document.getElementById('refundForm').action =
        '/admin/pembayaran/' + encodeURIComponent(id) + '/refund';

    document.getElementById('refundModal').classList.add('show');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('show');
}

document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.remove('show');
        }
    });
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('show');
        });
    }
});
</script>

</body>
</html>
