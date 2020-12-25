
$(document).ready(function () {
    $('[data-mask]').inputmask()
    $('#startDate').datetimepicker({
        format: 'L',
        language: "vi",
        autoclose: true,
    });
    $('#endDate').datetimepicker({
        format: 'L',
        language: "vi",
        autoclose: true,
    });
    $("#custom-tabs-four-tab li a").on('click', function () {
        $(".pie-card .tab-content").addClass('hidden');
        let name = $(this).attr('data-name');
        $("#custom-tabs-two-" + name).removeClass('hidden');
    })
    let data = {};
    admin.common.api.get('dashboard/2', data).then(loadHomePageAdminCallback);
})

$(document).on("click", ".filterChart", function (e) {
    e.preventDefault();
    if ($(".start-date").length && $(".start-date").val().length && $(".end-date").length && $(".end-date").val().length) {
        let startDate = $(".start-date").val();
        let endDate = $(".end-date").val();
        let data = {
            startDate: startDate,
            endDate: endDate,
        }
        admin.common.api.get('dashboard/3', data).then(loadHomePageAdminCallback);
    }
    
})

function loadHomePageAdminCallback(response) {
    console.log(response);
    const MONTHS = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
    const WEEKS = ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"];
    let chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgba(60,141,188,0.9)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };
    let backgroundColor = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#8e5ea2', '#c45850', '#e8c3b9', '#3cba9f'];
    let label, labelxAxes, title;
    let i;
    let html = '';
    switch (response.sort) {
        case 1:
            labelxAxes = 'Tuần';
            label = 'Tuần';
            title = 'Doanh thu tuần';
            break;
        case 2:
            labelxAxes = 'Tháng';
            label = 'Tháng ' + new Date().getMonth();
            title = 'Doanh thu tháng ' + new Date().getMonth();
            break;
        case 3:
            labelxAxes = 'Năm';
            label = 'Năm ' + new Date().getFullYear();
            title = 'Doanh thu năm ' + new Date().getFullYear();
            break;
        default:
            break;
    }

    // revenue
    let type = response.sort == 0 ? 'giờ' : (response.sort == 1 ? '1 tuần' : (response.sort == 2 ? '1 tháng' : '1 năm'));
    $(".total-revenue").html(float2Vnd(response.revenue));
    $(".total-user").html(response.countUser);
    $(".total-product").html(response.countProductSold);
    $(".total-order").html(response.countOrder);
    $(".progress-revenue").html(calculateGrowthRate(response.revenue, response.revenueAgo, type));
    $(".progress-user").html(calculateGrowthRate(response.countUser, response.countUserAgo, type));
    $(".progress-product").html(calculateGrowthRate(response.countProductSold, response.countProductSoldAgo, type));
    $(".progress-order").html(calculateGrowthRate(response.countOrder, response.countOrderAgo, type));

    // table category
    let categoryDetail = response.categoryDetail;
    let categoryLabel = [];
    let categoryCount = [];
    let categoryRevenue = [];
    for (i = 0; i < categoryDetail.length; i++) {
        html += ' <tr><td>' + (i + 1) + '</td>' +
            '<td>' + categoryDetail[i].name + '</td>' +
            '<td>' + categoryDetail[i].quantity + '</td>' +
            '<td>' + float2Vnd(Number(categoryDetail[i].total)) + '</td></tr>';
        categoryLabel.push(categoryDetail[i].name);
        categoryCount.push(categoryDetail[i].quantity);
        categoryRevenue.push(Number(categoryDetail[i].total));
    }
    $(".bodyCategory").html(html);

    // table product
    let productDetail = response.productDetail;
    let productLabel = [];
    let productCount = [];
    let productRevenue = [];
    html = '';
    for (i = 0; i < productDetail.length; i++) {
        html += ' <tr><td>' + (i + 1) + '</td>' +
            '<td>' + productDetail[i].name + '</td>' +
            '<td>' + productDetail[i].quantity + '</td>' +
            '<td>' + float2Vnd(Number(productDetail[i].total)) + '</td></tr>';
        productLabel.push(productDetail[i].name);
        productCount.push(productDetail[i].quantity);
        productRevenue.push(Number(productDetail[i].total));
    }
    $(".bodyProduct").html(html);

    // table customer
    let customerDetail = response.customerDetail;
    let customerLabel = [];
    let customerCount = [];
    let customerRevenue = [];
    html = '';
    for (i = 0; i < customerDetail.length; i++) {
        html += ' <tr><td>' + (i + 1) + '</td>' +
            '<td>' + customerDetail[i].name + '</td>' +
            '<td>' + customerDetail[i].email + '</td>' +
            '<td>' + customerDetail[i].quantity + '</td>' +
            '<td>' + float2Vnd(Number(customerDetail[i].total)) + '</td></tr>';
        customerLabel.push(customerDetail[i].name);
        customerCount.push(customerDetail[i].quantity);
        customerRevenue.push(Number(customerDetail[i].total));
    }
    $(".bodyCustomer").html(html);

    // chart revenue
    let unitTime = [], data = [], dataAgo = [];
    let revenue = response.revenueByTime;
    let revenueAgo = response.revenueByTimeAgo;
    switch (response.sort) {
        case 0:
            break;
        case 1:
            unitTime = WEEKS;
            break;
        case 2:
            break;
        case 3:
            unitTime = MONTHS;
            break;
        default:
            break;

    }
    for (i = 0; i < revenue.length; i++) {
        data.push(revenue[i][1]);
    }
    for (i = 0; i < revenueAgo.length; i++) {
        dataAgo.push(revenueAgo[i][1]);
    }
    let revenueConfig = {
        type: 'line',
        data: {
            labels: unitTime,
            datasets: [{
                label: label,
                borderColor: chartColors.blue,
                backgroundColor: chartColors.blue,
                data: data,
            },
            {
                label: label,
                backgroundColor: chartColors.grey,
                borderColor: chartColors.grey,
                data: dataAgo,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            },
            tooltips: {
                mode: 'label',
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: labelxAxes
                    },
                    ticks: {
                        min: 'Tháng 3'
                    }
                }],
                yAxes: [{
                    display: true,
                    beginAtZero: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Doanh thu (triệu đồng)"
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (value, index, values) {
                            return float2Vnd(value);
                        }
                    }
                }],
            }
        }
    };
    let revenueCtx = document.getElementById("areaChart").getContext("2d");
    window.myLine = new Chart(revenueCtx, revenueConfig);

    //pie category chart
    let pieOptions = {
        maintainAspectRatio: true,
        responsive: true,
        // tooltips: {
        //     title: {
        //         display: true,
        //         text: 'Doanh thu',
        //         fontStyle: 'bold',
        //         fontSize: 20
        //     },
        //     callback: function (value, index, values) {
        //         return float2Vnd(value);
        //     }
        // }
    }
    let pieRevenueCategoryCanvas = document.getElementById("pieRevenueCategoryChart").getContext('2d');
    let pieCountCategoryCanvas = document.getElementById("pieCountCategoryChart").getContext('2d');
    let categoryRevenueData = {
        labels: categoryLabel,
        datasets: [
            {
                data: categoryRevenue,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let categoryCountData = {
        labels: categoryLabel,
        datasets: [
            {
                data: categoryCount,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let pieRevenueCategoryChart = new Chart(pieRevenueCategoryCanvas, {
        type: 'pie',
        data: categoryRevenueData,
        options: pieOptions
    })
    let pieCountCategoryChart = new Chart(pieCountCategoryCanvas, {
        type: 'pie',
        data: categoryCountData,
        options: pieOptions
    })

    // pie product chart
    let pieRevenueProductCanvas = document.getElementById("pieRevenueProductChart").getContext('2d');
    let pieCountProductCanvas = document.getElementById("pieCountProductChart").getContext('2d');
    let productRevenueData = {
        labels: productLabel,
        datasets: [
            {
                data: productRevenue,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let productCountData = {
        labels: productLabel,
        datasets: [
            {
                data: productCount,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let pieRevenueProductChart = new Chart(pieRevenueProductCanvas, {
        type: 'pie',
        data: productRevenueData,
        options: pieOptions
    })
    let pieProductCategoryChart = new Chart(pieCountProductCanvas, {
        type: 'pie',
        data: productCountData,
        options: pieOptions
    })

    // pie customer chart
    let pieRevenueCustomerCanvas = document.getElementById("pieRevenueCustomerChart").getContext('2d');
    let pieCountCustomerCanvas = document.getElementById("pieCountCustomerChart").getContext('2d');
    let customerRevenueData = {
        labels: customerLabel,
        datasets: [
            {
                data: customerRevenue,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let customerCountData = {
        labels: customerLabel,
        datasets: [
            {
                data: customerCount,
                backgroundColor: backgroundColor,
            }
        ]
    }
    let pieRevenueCustomerChart = new Chart(pieRevenueCustomerCanvas, {
        type: 'pie',
        data: customerRevenueData,
        options: pieOptions
    })
    let pieCustomerCategoryChart = new Chart(pieCountCustomerCanvas, {
        type: 'pie',
        data: customerCountData,
        options: pieOptions
    })

}

function float2Vnd(value) {
    return value.toLocaleString('it-IT', { style: 'currency', currency: 'VND' });
}

function calculateGrowthRate(value, valueAgo, type) {
    valueAgo = valueAgo > 0 ? valueAgo : 1;
    html = 'Tăng ' + Math.round(100 * value / valueAgo) + ' % trong ' + type;
    return html;
}
