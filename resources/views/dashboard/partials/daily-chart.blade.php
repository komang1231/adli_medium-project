<div class="card dashboard-chart-card">

    <div class="card-header py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h5 class="mb-1">
                    Transaksi Harian
                </h5>

                <small>
                    Total transaksi per jam (08.00 - 18.00)
                </small>

            </div>

            <div class="d-flex align-items-center gap-2">

                <button
                    id="prevDay"
                    class="btn btn-light">

                    <i class="bi bi-chevron-left"></i>

                </button>

                <input
                    type="date"
                    id="selectedDate"
                    class="form-control">

                <button
                    id="nextDay"
                    class="btn btn-light">

                    <i class="bi bi-chevron-right"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="card-body">

        <div id="dailyChart"></div>

    </div>

</div>