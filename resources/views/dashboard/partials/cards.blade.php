<div class="row">

    @foreach($cards as $index => $card)

        <div class="{{ $card['col'] }} mb-4">

            <div class="card dashboard-card dashboard-card-{{ $index+1 }}">

                <div class="card-body">

                    <h6>{{ $card['title'] }}</h6>

                    <h2>{{ $card['value'] }}</h2>

                </div>

            </div>

        </div>

    @endforeach

</div>