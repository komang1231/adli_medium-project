<div class="card dashboard-chart-card shadow-sm mt-4">

    <div class="card-header py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h5 class="fw-bold mb-1">

                    Transaksi Tahunan

                </h5>

                <small>

                    Statistik transaksi per bulan

                </small>

            </div>

            <div class="d-flex align-items-center gap-2">

                <button
                    id="prevYear"
                    class="btn btn-light">

                    <i class="bi bi-chevron-left"></i>

                </button>

                <select
                    id="selectedYear"
                    class="form-select">

                    @for($i = now()->year; $i >= now()->year-5; $i--)

                        <option value="{{ $i }}">

                            {{ $i }}

                        </option>

                    @endfor

                </select>

                <button
                    id="nextYear"
                    class="btn btn-light">

                    <i class="bi bi-chevron-right"></i>

                </button>

                <select
                    id="chartView"
                    class="form-select">

                    <option value="Total">

                        Total

                    </option>

                    <option value="Detail">

                        Detail

                    </option>

                </select>

            </div>

        </div>

    </div>

    <div class="card-body pt-0">

        <div id="yearlyChart"></div>

    </div>

</div>