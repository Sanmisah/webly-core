<?= $this->extend('Webly\Core\Views\Layouts\default') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Website Visits</h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Top Pages</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Page</th>
                            <th style="width: 40px">Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($topPages as $i => $page) : ?>
                        <tr>
                            <td><?= ($i + 1)?>.</td>
                            <?php
                                $url = $page->path;
                                $url .= !empty($page->query) ? '?' . $page->query : '';
                            ?>
                            <td><a href="<?= site_url($url) ?>" target="_blank"><?= $url ?></a></td>
                            <td><span class="badge bg-success"><?= $page->views ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="/templates/adminlte3/dist/js/pages/common.js"></script>
    <script src="/templates/adminlte3/plugins/moment/moment.min.js"></script>
    <script src="/templates/adminlte3/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            var labels = <?= json_encode($days) ?>;
            var data = <?= json_encode($data) ?>;
            var stepSize = <?= json_encode($stepSize); ?>

            // Visit graph chart
            var visitGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            var visitGraphChartData = {
                // labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
                labels: labels,
                datasets: [
                {
                    label: 'Daily Visits',
                    fill: false,
                    borderWidth: 2,
                    lineTension: 0,
                    spanGaps: true,
                    borderColor: '#cfcfcf',
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointColor: '#000',
                    pointBackgroundColor: '#000',
                    data: data
                }
                ]
            }

            var visitGraphChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#17a2b8'
                    },
                        gridLines: {
                        display: false,
                        color: '#17a2b8',
                        drawBorder: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: stepSize,
                        fontColor: '#17a2b8'
                    },
                    gridLines: {
                        display: true,
                        color: '#17a2b8',
                        drawBorder: false
                    }
                }]
                }
            }
            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var visitGraphChart = new Chart(visitGraphChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'line',
                data: visitGraphChartData,
                options: visitGraphChartOptions
            });        
        });
    </script>    
<?= $this->endSection() ?>
