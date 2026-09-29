<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $location->nama_lokasi }} - EVChargeHub
    </title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 0;
        }

        .info {
            margin: 12px 0;
            line-height: 1.6;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #e9ecef;
            font-size: 14px;
        }

        .availability {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .availability-box {
            padding: 18px;
            border-radius: 10px;
            text-align: center;
            background: #f8f9fa;
        }

        .availability-box .number {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .charger {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 18px;
            margin-top: 15px;
        }

        .charger-title {
            font-size: 18px;
            font-weight: bold;
        }

        .charger-info {
            margin-top: 8px;
        }

        .available {
            color: #198754;
            font-weight: bold;
        }

        .used {
            color: #dc3545;
            font-weight: bold;
        }

        .offline {
            color: #6c757d;
            font-weight: bold;
        }

        .broken {
            color: #dc3545;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .btn-back {
            background: #6c757d;
        }

        .btn-map {
            background: #198754;
        }

        .btn-select {
            background: #0d6efd;
            margin-top: 12px;
        }

        .map-container {
            margin-top: 15px;
        }

        .map-container iframe {
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 10px;
        }

        /* =========================
           RATING & ULASAN
        ========================= */

        .review-section {
            margin-top: 30px;
            background: white;
            border-radius: 18px;
            padding: 25px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .review-section h2 {
            margin: 0 0 20px;
            color: #064e3b;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 20px;
            background: #f0fdf4;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .rating-number {
            font-size: 42px;
            font-weight: bold;
            color: #087f5b;
        }

        .stars {
            font-size: 22px;
            letter-spacing: 2px;
        }

        .rating-total {
            margin-top: 5px;
            color: #64748b;
            font-size: 13px;
        }

        .review-form {
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            margin-bottom: 25px;
        }

        .review-form h3,
        .review-list h3 {
            color: #064e3b;
            margin-top: 0;
        }

        .review-form label {
            display: block;
            margin: 15px 0 8px;
            font-weight: bold;
            font-size: 13px;
            color: #374151;
        }

        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 3px;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            font-size: 28px;
            cursor: pointer;
            margin: 0;
            filter: grayscale(1);
            transition: 0.2s;
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            filter: grayscale(0);
        }

        .review-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            resize: vertical;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            box-sizing: border-box;
        }

        .review-form textarea:focus {
            outline: none;
            border-color: #07895f;
        }

        .review-button {
            margin-top: 15px;
            padding: 11px 18px;
            background: #07895f;
            color: white;
            border: none;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
        }

        .review-button:hover {
            background: #056c4c;
        }

        .review-card {
            padding: 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        .review-card:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .review-header strong {
            color: #064e3b;
            font-size: 14px;
        }

        .review-header span {
            font-size: 16px;
        }

        .review-card p {
            margin: 10px 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .review-card small {
            color: #94a3b8;
            font-size: 11px;
        }

        .empty-review {
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        .success-message {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .error-message {
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        @media (max-width: 700px) {

            .availability {
                grid-template-columns: repeat(2, 1fr);
            }

            .review-header {
                flex-direction: column;
                align-items: flex-start;
            }

        }

    </style>

</head>


<body>

<div class="container">


    {{-- =========================================
         1. DETAIL CHARGING STATION
    ========================================= --}}

    <div class="card">

        <h1>
            {{ $location->nama_lokasi }}
        </h1>

        <div class="info">

            <strong>Status Station:</strong>

            <span class="status">
                {{ ucfirst($location->status) }}
            </span>

        </div>


        <div class="info">

            <strong>Alamat:</strong>

            <br>

            {{ $location->alamat }}

        </div>


        <div class="info">

            <strong>Jam Operasional:</strong>

            <br>

            {{ $location->jam_buka ?? '-' }}

            -

            {{ $location->jam_tutup ?? '-' }}

        </div>


        <div class="info">

            <strong>Fasilitas:</strong>

            <br>

            {{ $location->fasilitas ?? 'Tidak ada informasi fasilitas.' }}

        </div>

    </div>


    {{-- =========================================
         2. KETERSEDIAAN CHARGER
    ========================================= --}}

    <div class="card">

        <h2>
            Ketersediaan Charger
        </h2>


        <div class="availability">


            <div class="availability-box">

                <div class="number">
                    {{ $totalCharger }}
                </div>

                Total Charger

            </div>


            <div class="availability-box">

                <div class="number available">
                    {{ $chargerTersedia }}
                </div>

                Tersedia

            </div>


            <div class="availability-box">

                <div class="number used">
                    {{ $chargerDigunakan }}
                </div>

                Digunakan

            </div>


            <div class="availability-box">

                <div class="number offline">
                    {{ $chargerOffline + $chargerRusak }}
                </div>

                Gangguan

            </div>

        </div>

    </div>


    {{-- =========================================
         3. DAFTAR CHARGER
    ========================================= --}}

    <div class="card">

        <h2>
            Daftar Charger
        </h2>


        @forelse($location->chargers as $charger)

            <div class="charger">

                <div class="charger-title">

                    {{ $charger->kode_perangkat }}

                </div>


                <div class="charger-info">

                    <strong>
                        Tipe Konektor:
                    </strong>

                    {{ $charger->tipe_konektor }}

                </div>


                <div class="charger-info">

                    <strong>
                        Daya:
                    </strong>

                    {{ $charger->daya_kw }} kW

                </div>


                <div class="charger-info">

                    <strong>
                        Status:
                    </strong>

                    @if($charger->status === 'tersedia')

                        <span class="available">
                            Tersedia
                        </span>

                    @elseif($charger->status === 'digunakan')

                        <span class="used">
                            Sedang Digunakan
                        </span>

                    @elseif($charger->status === 'offline')

                        <span class="offline">
                            Offline
                        </span>

                    @else

                        <span class="broken">
                            Rusak
                        </span>

                    @endif

                </div>


                @if($charger->status === 'tersedia')

                    <a
                        href="{{ route('charging.create', $charger->id_charger) }}"
                        class="btn btn-select"
                    >
                        Pilih Charger
                    </a>

                @endif

            </div>

        @empty

            <p>
                Belum ada charger di station ini.
            </p>

        @endforelse

    </div>


    {{-- =========================================
         4. RATING DAN ULASAN
    ========================================= --}}

    <div class="review-section">

        <h2>
            ⭐ Rating & Ulasan
        </h2>


        {{-- RATING RATA-RATA --}}

        @php

            $averageRating = $location->reviews->avg('rating') ?? 0;

            $totalReviews = $location->reviews->count();

        @endphp


        <div class="rating-summary">

            <div class="rating-number">
                {{ number_format($averageRating, 1) }}
            </div>


            <div>

                <div class="stars">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= round($averageRating))

                            ⭐

                        @else

                            ☆

                        @endif

                    @endfor

                </div>


                <div class="rating-total">

                    {{ $totalReviews }}
                    ulasan

                </div>

            </div>

        </div>


        {{-- FORM RATING --}}

        <div class="review-form">

            <h3>
                Berikan Rating dan Ulasan
            </h3>


            @if(session('success'))

                <div class="success-message">

                    {{ session('success') }}

                </div>

            @endif


            @if($errors->any())

                <div class="error-message">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <form
                action="{{ route('station.reviews.store', $location->id_location) }}"
                method="POST"
            >

                @csrf


                <label>
                    Rating
                </label>


                <div class="rating-input">

                    @for($i = 5; $i >= 1; $i--)

                        <input
                            type="radio"
                            name="rating"
                            value="{{ $i }}"
                            id="star{{ $i }}"
                            required
                        >

                        <label
                            for="star{{ $i }}"
                        >
                            ⭐
                        </label>

                    @endfor

                </div>


                <label for="ulasan">
                    Ulasan
                </label>


                <textarea
                    name="ulasan"
                    id="ulasan"
                    rows="4"
                    maxlength="1000"
                    placeholder="Bagaimana pengalaman Anda di charging station ini?"
                ></textarea>


                <button
                    type="submit"
                    class="review-button"
                >
                    ⭐ Kirim Rating & Ulasan
                </button>

            </form>

        </div>


        {{-- DAFTAR ULASAN --}}

        <div class="review-list">

            <h3>
                Ulasan Pengguna
            </h3>


        @forelse($location->reviews->sortByDesc('created_at') as $review)

            <div class="review-card">

                <div class="review-header">

                    <strong>
                        {{ $review->user->nama ?? 'Pengguna' }}
                    </strong>

                    <span>
                        {{ str_repeat('★', $review->rating) }}
                        {{ str_repeat('☆', 5 - $review->rating) }}
                    </span>

                </div>

                @if($review->ulasan)

                    <p>
                        {{ $review->ulasan }}
                    </p>

                @endif

                <small>
                    {{ $review->created_at
                        ? $review->created_at->format('d/m/Y H:i')
                        : '-' }}
                </small>

            </div>

        @empty

            <div class="empty-review">
                Belum ada ulasan untuk station ini.
            </div>

        @endforelse

    </div>


    {{-- =========================================
         5. LOKASI CHARGING STATION
    ========================================= --}}

    <div class="card">

        <h2>
            Lokasi Charging Station
        </h2>


        <div class="info">

            <strong>
                Alamat:
            </strong>

            <br>

            {{ $location->alamat }}

        </div>


        <div class="info">

            <strong>
                Latitude:
            </strong>

            {{ $location->latitude }}

        </div>


        <div class="info">

            <strong>
                Longitude:
            </strong>

            {{ $location->longitude }}

        </div>


        {{-- Tampilan peta --}}

        <div class="map-container">

            <iframe
                src="https://www.google.com/maps?q={{ $location->latitude }},{{ $location->longitude }}&output=embed"
                loading="lazy">
            </iframe>

        </div>

    </div>


    {{-- =========================================
         6. NAVIGASI
    ========================================= --}}

    <div class="card">

        <h2>
            Navigasi
        </h2>

        <p>
            Gunakan tombol berikut untuk mendapatkan
            petunjuk arah menuju charging station.
        </p>


        <div class="buttons">

            <a
                href="{{ route('stations.index') }}"
                class="btn btn-back"
            >
                ← Kembali
            </a>


            <a
                href="https://www.google.com/maps/dir/?api=1&destination={{ $location->latitude }},{{ $location->longitude }}"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-map"
            >
                📍 Navigasi ke Station
            </a>

        </div>

    </div>


</div>

</body>

</html>