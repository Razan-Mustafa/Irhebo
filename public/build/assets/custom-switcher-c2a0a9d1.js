var Xt = Object.defineProperty;
var jt = (t, r, o) =>
    r in t
        ? Xt(t, r, { enumerable: !0, configurable: !0, writable: !0, value: o })
        : (t[r] = o);
var J = (t, r, o) => (jt(t, typeof r != "symbol" ? r + "" : r, o), o);
var g = document.getElementById("crm-main");
if (g !== null) {
    g.innerHTML = "";
    var Be = {
            chart: { height: 127, width: 100, type: "radialBar" },
            series: [48],
            colors: ["rgba(255,255,255,0.9)"],
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "55%", background: "#fff" },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#4b9bfa",
                            fontSize: ".625rem",
                            show: !1,
                        },
                        value: {
                            offsetY: 5,
                            color: "#4b9bfa",
                            fontSize: ".875rem",
                            show: !0,
                            fontWeight: 600,
                        },
                    },
                },
            },
            stroke: { lineCap: "round" },
            labels: ["Status"],
        },
        oe = new ApexCharts(document.querySelector("#crm-main"), Be);
    oe.render();
}
var g = document.getElementById("crm-total-customers");
if (g !== null) {
    g.innerHTML = "";
    var V = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 23, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(132, 90, 223)"],
        },
        V = new ApexCharts(document.querySelector("#crm-total-customers"), V);
    V.render();
}
function Ut(t) {
    function r(o, a, l) {
        return (
            "#" + ((1 << 24) | (o << 16) | (a << 8) | l).toString(16).slice(1)
        );
    }
    V.updateOptions({
        colors: [r(t.split(",")[0], t.split(",")[1], t.split(",")[2])],
    });
}
var g = document.getElementById("crm-total-revenue");
if (g !== null) {
    g.innerHTML = "";
    var ne = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 20, 22, 9, 12, 19, 10, 25] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(35, 183, 229)"],
        },
        ne = new ApexCharts(document.querySelector("#crm-total-revenue"), ne);
    ne.render();
}
var g = document.getElementById("crm-conversion-ratio");
if (g !== null) {
    g.innerHTML = "";
    var se = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 20, 22, 9, 14, 19, 10, 25, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(38, 191, 148)"],
        },
        se = new ApexCharts(
            document.querySelector("#crm-conversion-ratio"),
            se
        );
    se.render();
}
var g = document.getElementById("crm-total-deals");
if (g !== null) {
    g.innerHTML = "";
    var ie = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 20, 22, 9, 12, 14, 19, 10, 25] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(245, 184, 73)"],
        },
        ie = new ApexCharts(document.querySelector("#crm-total-deals"), ie);
    ie.render();
}
var g = document.getElementById("crm-revenue-analytics");
if (g !== null) {
    g.innerHTML = "";
    var Be = {
            series: [
                {
                    type: "line",
                    name: "Profit",
                    data: [
                        { x: "Jan", y: 100 },
                        { x: "Feb", y: 210 },
                        { x: "Mar", y: 180 },
                        { x: "Apr", y: 454 },
                        { x: "May", y: 230 },
                        { x: "Jun", y: 320 },
                        { x: "Jul", y: 656 },
                        { x: "Aug", y: 830 },
                        { x: "Sep", y: 350 },
                        { x: "Oct", y: 350 },
                        { x: "Nov", y: 210 },
                        { x: "Dec", y: 410 },
                    ],
                },
                {
                    type: "line",
                    name: "Revenue",
                    chart: {
                        dropShadow: {
                            enabled: !0,
                            enabledOnSeries: void 0,
                            top: 5,
                            left: 0,
                            blur: 3,
                            color: "#000",
                            opacity: 0.1,
                        },
                    },
                    data: [
                        { x: "Jan", y: 180 },
                        { x: "Feb", y: 620 },
                        { x: "Mar", y: 476 },
                        { x: "Apr", y: 220 },
                        { x: "May", y: 520 },
                        { x: "Jun", y: 780 },
                        { x: "Jul", y: 435 },
                        { x: "Aug", y: 515 },
                        { x: "Sep", y: 738 },
                        { x: "Oct", y: 454 },
                        { x: "Nov", y: 525 },
                        { x: "Dec", y: 230 },
                    ],
                },
                {
                    type: "area",
                    name: "Sales",
                    chart: {
                        dropShadow: {
                            enabled: !0,
                            enabledOnSeries: void 0,
                            top: 5,
                            left: 0,
                            blur: 3,
                            color: "#000",
                            opacity: 0.1,
                        },
                    },
                    data: [
                        { x: "Jan", y: 200 },
                        { x: "Feb", y: 530 },
                        { x: "Mar", y: 110 },
                        { x: "Apr", y: 130 },
                        { x: "May", y: 480 },
                        { x: "Jun", y: 520 },
                        { x: "Jul", y: 780 },
                        { x: "Aug", y: 435 },
                        { x: "Sep", y: 475 },
                        { x: "Oct", y: 738 },
                        { x: "Nov", y: 454 },
                        { x: "Dec", y: 480 },
                    ],
                },
            ],
            chart: {
                height: 350,
                animations: { speed: 500 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 8,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            colors: [
                "rgb(132, 90, 223)",
                "rgba(35, 183, 229, 0.85)",
                "rgba(119, 119, 142, 0.05)",
            ],
            dataLabels: { enabled: !1 },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            stroke: { curve: "smooth", width: [2, 2, 0], dashArray: [0, 5, 0] },
            xaxis: { axisTicks: { show: !1 } },
            yaxis: {
                labels: {
                    formatter: function (o) {
                        return "$" + o;
                    },
                },
            },
            tooltip: {
                y: [
                    {
                        formatter: function (o) {
                            return o !== void 0 ? "$" + o.toFixed(0) : o;
                        },
                    },
                    {
                        formatter: function (o) {
                            return o !== void 0 ? "$" + o.toFixed(0) : o;
                        },
                    },
                    {
                        formatter: function (o) {
                            return o !== void 0 ? o.toFixed(0) : o;
                        },
                    },
                ],
            },
            legend: {
                show: !0,
                customLegendItems: ["Profit", "Revenue", "Sales"],
                inverseOrder: !0,
            },
            title: {
                text: "Revenue Analytics with sales & profit (USD)",
                align: "left",
                style: {
                    fontSize: ".8125rem",
                    fontWeight: "semibold",
                    color: "#8c9097",
                },
            },
            markers: { hover: { sizeOffset: 5 } },
        },
        oe = new ApexCharts(
            document.querySelector("#crm-revenue-analytics"),
            Be
        );
    oe.render();
}
function Kt(t) {
    oe.updateOptions({
        colors: [
            "rgba(" + t + ", 1)",
            "rgba(35, 183, 229, 0.85)",
            "rgba(119, 119, 142, 0.05)",
        ],
    });
}
var g = document.getElementById("crm-profits-earned");
if (g !== null) {
    g.innerHTML = "";
    var Qt = {
            series: [
                { name: "Profit Earned", data: [44, 42, 57, 86, 58, 55, 70] },
                { name: "Total Sales", data: [34, 22, 37, 56, 21, 35, 60] },
            ],
            chart: { type: "bar", height: 180, toolbar: { show: !1 } },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            colors: ["rgb(132, 90, 223)", "#e4e7ed"],
            plotOptions: {
                bar: {
                    colors: {
                        ranges: [
                            { from: -100, to: -46, color: "#ebeff5" },
                            { from: -45, to: 0, color: "#ebeff5" },
                        ],
                    },
                    columnWidth: "60%",
                    borderRadius: 5,
                },
            },
            dataLabels: { enabled: !1 },
            stroke: { show: !0, width: 2, colors: void 0 },
            legend: { show: !1, position: "top" },
            yaxis: {
                title: {
                    style: {
                        color: "#adb5be",
                        fontSize: "13px",
                        fontFamily: "poppins, sans-serif",
                        fontWeight: 600,
                        cssClass: "apexcharts-yaxis-label",
                    },
                },
                labels: {
                    formatter: function (t) {
                        return t.toFixed(0) + "";
                    },
                },
            },
            xaxis: {
                type: "week",
                categories: ["S", "M", "T", "W", "T", "F", "S"],
                axisBorder: {
                    show: !0,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !0,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
        },
        St = new ApexCharts(document.querySelector("#crm-profits-earned"), Qt);
    St.render();
}
function Zt(t) {
    St.updateOptions({ colors: ["rgba(" + t + ", 1)", "#ededed"] });
}
let U;
function Vt(t) {
    typeof U < "u" && U !== null && U.destroy(),
        (Chart.defaults.elements.arc.borderWidth = 0),
        (Chart.defaults.datasets.doughnut.cutout = "85%"),
        (U = new Chart(document.getElementById("leads-source"), {
            type: "doughnut",
            data: {
                datasets: [
                    {
                        label: "My First Dataset",
                        data: [32, 27, 25, 16],
                        backgroundColor: [
                            `rgb(${t})`,
                            "rgb(35, 183, 229)",
                            "rgb(245, 184, 73)",
                            "rgb(38, 191, 148)",
                        ],
                    },
                ],
            },
            plugins: [
                {
                    afterUpdate: function (r) {
                        r.getDatasetMeta(0).data.forEach(function (a) {
                            a.round = {
                                x: (r.chartArea.left + r.chartArea.right) / 2,
                                y: (r.chartArea.top + r.chartArea.bottom) / 2,
                                radius: (a.outerRadius + a.innerRadius) / 2,
                                thickness: (a.outerRadius - a.innerRadius) / 2,
                                backgroundColor: a.options.backgroundColor,
                            };
                        });
                    },
                    afterDraw: (r) => {
                        const { ctx: o, canvas: a } = r;
                        r.getDatasetMeta(0).data.forEach((l) => {
                            Math.PI / 2 - l.startAngle;
                            const s = Math.PI / 2 - l.endAngle;
                            o.save(),
                                o.translate(l.round.x, l.round.y),
                                (o.fillStyle = l.options.backgroundColor),
                                o.beginPath(),
                                o.arc(
                                    l.round.radius * Math.sin(s),
                                    l.round.radius * Math.cos(s),
                                    l.round.thickness,
                                    0,
                                    2 * Math.PI
                                ),
                                o.closePath(),
                                o.fill(),
                                o.restore();
                        });
                    },
                },
            ],
        }));
}
var bt = document.getElementById("earnings");
if (bt !== null) {
    bt.innerHTML = "";
    var er = {
            series: [
                {
                    name: "Total Orders",
                    data: [44, 42, 57, 86, 112, 55, 70, 43, 23, 54, 77, 34],
                },
            ],
            chart: { type: "bar", height: 200 },
            grid: { borderColor: "#f2f6f7" },
            colors: [
                "rgba(132, 90, 223, 0.3)",
                "rgba(132, 90, 223, 0.3)",
                "rgba(132, 90, 223, 0.3)",
                "rgba(132, 90, 223, 0.3)",
                "rgb(132, 90, 223)",
                "rgba(132, 90, 223, 0.3)",
                "#e4e7ed",
                "#e4e7ed",
                "#e4e7ed",
                "#e4e7ed",
                "#e4e7ed",
                "#e4e7ed",
            ],
            plotOptions: {
                bar: { columnWidth: "25%", distributed: !0, borderRadius: 7 },
            },
            dataLabels: { enabled: !1 },
            legend: { show: !1 },
            yaxis: {
                title: {
                    style: {
                        color: "#adb5be",
                        fontSize: "12px",
                        fontFamily: "Montserrat, sans-serif",
                        fontWeight: 500,
                        cssClass: "apexcharts-yaxis-label",
                    },
                },
                labels: {
                    formatter: function (t) {
                        return t.toFixed(0) + "";
                    },
                },
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "sep",
                    "oct",
                    "nov",
                    "dec",
                ],
                axisBorder: {
                    show: !0,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !0,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
        },
        xt = new ApexCharts(document.querySelector("#earnings"), er);
    xt.render();
}
function tr(t) {
    xt.updateOptions({
        colors: [
            "rgba(" + t + ", 0.3)",
            "rgba(" + t + ", 0.3)",
            "rgba(" + t + ", 0.3)",
            "rgba(" + t + ", 0.3)",
            "rgb(" + t + ")",
            "rgba(" + t + ", 0.3)",
            "#e4e7ed",
            "#e4e7ed",
            "#e4e7ed",
            "#e4e7ed",
            "#e4e7ed",
            "#e4e7ed",
        ],
    });
}
var m = document.getElementById("crypto");
if (m !== null) {
    m.innerHTML = "";
    var rr = {
            series: [
                {
                    data: [
                        {
                            x: new Date(15387786e5),
                            y: [6629.81, 6650.5, 6623.04, 6633.33],
                        },
                        {
                            x: new Date(15387804e5),
                            y: [6632.01, 6643.59, 6620, 6630.11],
                        },
                        {
                            x: new Date(15387822e5),
                            y: [6630.71, 6648.95, 6623.34, 6635.65],
                        },
                        {
                            x: new Date(1538784e6),
                            y: [6635.65, 6651, 6629.67, 6638.24],
                        },
                        {
                            x: new Date(15387858e5),
                            y: [6638.24, 6640, 6620, 6624.47],
                        },
                        {
                            x: new Date(15387876e5),
                            y: [6624.53, 6636.03, 6621.68, 6624.31],
                        },
                        {
                            x: new Date(15387894e5),
                            y: [6624.61, 6632.2, 6617, 6626.02],
                        },
                        {
                            x: new Date(15387912e5),
                            y: [6627, 6627.62, 6584.22, 6603.02],
                        },
                        {
                            x: new Date(1538793e6),
                            y: [6605, 6608.03, 6598.95, 6604.01],
                        },
                        {
                            x: new Date(15387948e5),
                            y: [6604.5, 6614.4, 6602.26, 6608.02],
                        },
                        {
                            x: new Date(15387966e5),
                            y: [6608.02, 6610.68, 6601.99, 6608.91],
                        },
                        {
                            x: new Date(15387984e5),
                            y: [6608.91, 6618.99, 6608.01, 6612],
                        },
                        {
                            x: new Date(15388002e5),
                            y: [6612, 6615.13, 6605.09, 6612],
                        },
                        {
                            x: new Date(1538802e6),
                            y: [6612, 6624.12, 6608.43, 6622.95],
                        },
                        {
                            x: new Date(15388038e5),
                            y: [6623.91, 6623.91, 6615, 6615.67],
                        },
                        {
                            x: new Date(15388056e5),
                            y: [6618.69, 6618.74, 6610, 6610.4],
                        },
                        {
                            x: new Date(15388074e5),
                            y: [6611, 6622.78, 6610.4, 6614.9],
                        },
                        {
                            x: new Date(15388092e5),
                            y: [6614.9, 6626.2, 6613.33, 6623.45],
                        },
                        {
                            x: new Date(1538811e6),
                            y: [6623.48, 6627, 6618.38, 6620.35],
                        },
                        {
                            x: new Date(15388128e5),
                            y: [6619.43, 6620.35, 6610.05, 6615.53],
                        },
                        {
                            x: new Date(15388146e5),
                            y: [6615.53, 6617.93, 6610, 6615.19],
                        },
                        {
                            x: new Date(15388164e5),
                            y: [6615.19, 6621.6, 6608.2, 6620],
                        },
                        {
                            x: new Date(15388182e5),
                            y: [6619.54, 6625.17, 6614.15, 6620],
                        },
                        {
                            x: new Date(153882e7),
                            y: [6620.33, 6634.15, 6617.24, 6624.61],
                        },
                        {
                            x: new Date(15388218e5),
                            y: [6625.95, 6626, 6611.66, 6617.58],
                        },
                        {
                            x: new Date(15388236e5),
                            y: [6619, 6625.97, 6595.27, 6598.86],
                        },
                        {
                            x: new Date(15388254e5),
                            y: [6598.86, 6598.88, 6570, 6587.16],
                        },
                        {
                            x: new Date(15388272e5),
                            y: [6588.86, 6600, 6580, 6593.4],
                        },
                        {
                            x: new Date(1538829e6),
                            y: [6593.99, 6598.89, 6585, 6587.81],
                        },
                        {
                            x: new Date(15388308e5),
                            y: [6587.81, 6592.73, 6567.14, 6578],
                        },
                        {
                            x: new Date(15388326e5),
                            y: [6578.35, 6581.72, 6567.39, 6579],
                        },
                        {
                            x: new Date(15388344e5),
                            y: [6579.38, 6580.92, 6566.77, 6575.96],
                        },
                        {
                            x: new Date(15388362e5),
                            y: [6575.96, 6589, 6571.77, 6588.92],
                        },
                        {
                            x: new Date(1538838e6),
                            y: [6588.92, 6594, 6577.55, 6589.22],
                        },
                        {
                            x: new Date(15388398e5),
                            y: [6589.3, 6598.89, 6589.1, 6596.08],
                        },
                        {
                            x: new Date(15388416e5),
                            y: [6597.5, 6600, 6588.39, 6596.25],
                        },
                        {
                            x: new Date(15388434e5),
                            y: [6598.03, 6600, 6588.73, 6595.97],
                        },
                        {
                            x: new Date(15388452e5),
                            y: [6595.97, 6602.01, 6588.17, 6602],
                        },
                        {
                            x: new Date(1538847e6),
                            y: [6602, 6607, 6596.51, 6599.95],
                        },
                        {
                            x: new Date(15388488e5),
                            y: [6600.63, 6601.21, 6590.39, 6591.02],
                        },
                        {
                            x: new Date(15388506e5),
                            y: [6591.02, 6603.08, 6591, 6591],
                        },
                        {
                            x: new Date(15388524e5),
                            y: [6591, 6601.32, 6585, 6592],
                        },
                        {
                            x: new Date(15388542e5),
                            y: [6593.13, 6596.01, 6590, 6593.34],
                        },
                        {
                            x: new Date(1538856e6),
                            y: [6593.34, 6604.76, 6582.63, 6593.86],
                        },
                        {
                            x: new Date(15388578e5),
                            y: [6593.86, 6604.28, 6586.57, 6600.01],
                        },
                        {
                            x: new Date(15388596e5),
                            y: [6601.81, 6603.21, 6592.78, 6596.25],
                        },
                        {
                            x: new Date(15388614e5),
                            y: [6596.25, 6604.2, 6590, 6602.99],
                        },
                        {
                            x: new Date(15388632e5),
                            y: [6602.99, 6606, 6584.99, 6587.81],
                        },
                        {
                            x: new Date(1538865e6),
                            y: [6587.81, 6595, 6583.27, 6591.96],
                        },
                        {
                            x: new Date(15388668e5),
                            y: [6591.97, 6596.07, 6585, 6588.39],
                        },
                        {
                            x: new Date(15388686e5),
                            y: [6587.6, 6598.21, 6587.6, 6594.27],
                        },
                        {
                            x: new Date(15388704e5),
                            y: [6596.44, 6601, 6590, 6596.55],
                        },
                        {
                            x: new Date(15388722e5),
                            y: [6598.91, 6605, 6596.61, 6600.02],
                        },
                        {
                            x: new Date(1538874e6),
                            y: [6600.55, 6605, 6589.14, 6593.01],
                        },
                        {
                            x: new Date(15388758e5),
                            y: [6593.15, 6605, 6592, 6603.06],
                        },
                        {
                            x: new Date(15388776e5),
                            y: [6603.07, 6604.5, 6599.09, 6603.89],
                        },
                        {
                            x: new Date(15388794e5),
                            y: [6604.44, 6604.44, 6600, 6603.5],
                        },
                        {
                            x: new Date(15388812e5),
                            y: [6603.5, 6603.99, 6597.5, 6603.86],
                        },
                        {
                            x: new Date(1538883e6),
                            y: [6603.85, 6605, 6600, 6604.07],
                        },
                        {
                            x: new Date(15388848e5),
                            y: [6604.98, 6606, 6604.07, 6606],
                        },
                    ],
                },
            ],
            chart: {
                type: "candlestick",
                borderRadius: 20,
                height: 275,
                toolbar: { show: !1 },
            },
            plotOptions: {
                candlestick: {
                    colors: {
                        upward: "rgb(132, 90, 223)",
                        downward: "rgba(132, 90, 223, 0.2)",
                    },
                },
            },
            title: { align: "left" },
            grid: { borderColor: "#f2f6f7" },
            xaxis: {
                type: "datetime",
                axisBorder: {
                    show: !1,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !1,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
            },
            yaxis: { tooltip: { enabled: !0 } },
        },
        kt = new ApexCharts(document.querySelector("#crypto"), rr);
    kt.render();
}
function or(t) {
    kt.updateOptions({
        plotOptions: {
            candlestick: {
                colors: {
                    upward: "rgb(" + t + ")",
                    downward: "rgba(" + t + ", 0.2)",
                },
            },
        },
    });
}
var m = document.getElementById("btc-chart");
if (m !== null) {
    m.innerHTML = "";
    var ce = {
            chart: {
                type: "line",
                height: 40,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [
                {
                    name: "Value",
                    data: [
                        0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41,
                        35, 27, 93, 53, 61, 27, 54, 43, 19, 46,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#26bf94"],
        },
        ce = new ApexCharts(document.querySelector("#btc-chart"), ce);
    ce.render();
}
var m = document.getElementById("eth-chart");
if (m !== null) {
    m.innerHTML = "";
    var de = {
            chart: {
                type: "line",
                height: 40,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [
                {
                    name: "Value",
                    data: [
                        0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41,
                        35, 27, 93, 53, 61, 27, 54, 43, 19, 46,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#26bf94"],
        },
        de = new ApexCharts(document.querySelector("#eth-chart"), de);
    de.render();
}
var m = document.getElementById("dash-chart");
if (m !== null) {
    m.innerHTML = "";
    var ue = {
            chart: {
                type: "line",
                height: 40,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [
                {
                    name: "Value",
                    data: [
                        0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41,
                        35, 27, 93, 53, 61, 27, 54, 43, 19, 46,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#e6533c"],
        },
        ue = new ApexCharts(document.querySelector("#dash-chart"), ue);
    ue.render();
}
var m = document.getElementById("bitcoin-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var me = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        0, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41,
                        35, 27, 93, 53, 61, 27, 54, 43, 19, 46,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#26bf94"],
        },
        me = new ApexCharts(document.querySelector("#bitcoin-price-graph"), me);
    me.render();
}
var m = document.getElementById("etherium-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var he = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        0, 45, 54, 38, 56, 24, 65, 35, 27, 93, 53, 61, 27, 54,
                        43, 19, 46, 31, 37, 39, 62, 51, 35, 41,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#e6533c"],
        },
        he = new ApexCharts(
            document.querySelector("#etherium-price-graph"),
            he
        );
    he.render();
}
var m = document.getElementById("dash-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var ye = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        61, 27, 54, 43, 19, 46, 31, 37, 39, 0, 45, 54, 38, 56,
                        24, 65, 35, 27, 93, 53, 62, 51, 35, 41,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#26bf94"],
        },
        ye = new ApexCharts(document.querySelector("#dash-price-graph"), ye);
    ye.render();
}
var m = document.getElementById("ripple-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var fe = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        61, 27, 54, 43, 19, 56, 24, 65, 35, 27, 93, 53, 46, 31,
                        37, 39, 0, 45, 54, 38, 62, 51, 35, 41,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#26bf94"],
        },
        fe = new ApexCharts(document.querySelector("#ripple-price-graph"), fe);
    fe.render();
}
var m = document.getElementById("iota-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var ge = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        61, 27, 54, 37, 39, 0, 45, 54, 38, 62, 51, 35, 41, 43,
                        19, 56, 24, 65, 35, 27, 93, 53, 46, 31,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#e6533c"],
        },
        ge = new ApexCharts(document.querySelector("#iota-price-graph"), ge);
    ge.render();
}
var m = document.getElementById("neo-price-graph");
if (m !== null) {
    m.innerHTML = "";
    var pe = {
            chart: {
                type: "line",
                height: 20,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            tooltip: { enabled: !1 },
            series: [
                {
                    name: "Value",
                    data: [
                        62, 51, 35, 41, 43, 19, 56, 24, 65, 35, 27, 93, 53, 46,
                        31, 61, 27, 54, 37, 39, 0, 45, 54, 38,
                    ],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#e6533c"],
        },
        pe = new ApexCharts(document.querySelector("#neo-price-graph"), pe);
    pe.render();
}
var N = document.getElementById("subscriptionOverview");
if (N !== null) {
    N.innerHTML = "";
    var Ie = {
            series: [
                {
                    name: "Basic",
                    data: [75, 78, 38, 39, 38, 73, 73, 53, 53, 16, 16, 53],
                },
                {
                    name: "Pro",
                    data: [35, 35, 62, 63, 13, 13, 60, 60, 41, 41, 82, 82],
                },
            ],
            chart: {
                toolbar: { show: !1 },
                height: 295,
                type: "line",
                zoom: { enabled: !1 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 5,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.15,
                },
            },
            grid: { borderColor: "#f1f1f1" },
            dataLabels: { enabled: !1 },
            stroke: {
                width: [2, 2],
                curve: ["smooth", "smooth"],
                lineCap: "butt",
                dashArray: [0, 0],
            },
            title: { text: void 0 },
            legend: {
                show: !0,
                position: "top",
                horizontalAlign: "center",
                fontWeight: 600,
                fontSize: "11px",
                tooltipHoverFormatter: function (t, r) {
                    return (
                        t +
                        " - " +
                        r.w.globals.series[r.seriesIndex][r.dataPointIndex]
                    );
                },
                labels: { colors: "#74767c" },
                markers: {
                    width: 7,
                    height: 7,
                    strokeWidth: 0,
                    radius: 12,
                    offsetX: 0,
                    offsetY: 0,
                },
            },
            markers: {
                discrete: [
                    {
                        seriesIndex: 0,
                        dataPointIndex: 5,
                        fillColor: "#305cfc",
                        strokeColor: "#fff",
                        size: 4,
                        shape: "circle",
                    },
                    {
                        seriesIndex: 0,
                        dataPointIndex: 11,
                        fillColor: "#305cfc",
                        strokeColor: "#fff",
                        size: 4,
                        shape: "circle",
                    },
                    {
                        seriesIndex: 1,
                        dataPointIndex: 10,
                        fillColor: "#23b7e5",
                        strokeColor: "#fff",
                        size: 4,
                        shape: "circle",
                    },
                    {
                        seriesIndex: 1,
                        dataPointIndex: 4,
                        fillColor: "#23b7e5",
                        strokeColor: "#fff",
                        size: 4,
                        shape: "circle",
                    },
                ],
                hover: { sizeOffset: 6 },
            },
            yaxis: {
                title: {
                    style: {
                        color: "#adb5be",
                        fontSize: "14px",
                        fontFamily: "poppins, sans-serif",
                        fontWeight: 600,
                        cssClass: "apexcharts-yaxis-label",
                    },
                },
                labels: {
                    formatter: function (t) {
                        return t.toFixed(0) + "";
                    },
                    show: !0,
                    style: {
                        colors: "#8c9097",
                        fontSize: "11px",
                        fontWeight: 600,
                        cssClass: "apexcharts-xaxis-label",
                    },
                },
            },
            xaxis: {
                type: "day",
                categories: [
                    "01 Jan",
                    "02 Jan",
                    "03 Jan",
                    "04 Jan",
                    "05 Jan",
                    "06 Jan",
                    "07 Jan",
                    "08 Jan",
                    "09 Jan",
                    "10 Jan",
                    "11 Jan",
                    "12 Jan",
                ],
                axisBorder: {
                    show: !0,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !0,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: {
                    rotate: -90,
                    style: {
                        colors: "#8c9097",
                        fontSize: "11px",
                        fontWeight: 600,
                        cssClass: "apexcharts-xaxis-label",
                    },
                },
            },
            tooltip: {
                y: [
                    {
                        title: {
                            formatter: function (t) {
                                return t;
                            },
                        },
                    },
                    {
                        title: {
                            formatter: function (t) {
                                return t;
                            },
                        },
                    },
                    {
                        title: {
                            formatter: function (t) {
                                return t;
                            },
                        },
                    },
                ],
            },
            colors: ["rgb(132, 90, 223)", "#23b7e5"],
        },
        qt = new ApexCharts(
            document.querySelector("#subscriptionOverview"),
            Ie
        );
    qt.render();
}
function ar(t) {
    qt.updateOptions({ colors: ["rgb(" + t + ")", "#23b7e5"] });
}
var N = document.getElementById("candidates-chart");
if (N !== null) {
    N.innerHTML = "";
    var Ie = {
            series: [1754, 1234],
            labels: ["Female", "Male"],
            chart: { height: 260, type: "donut" },
            dataLabels: { enabled: !1 },
            legend: { show: !1 },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "round",
                colors: "#fff",
                width: 0,
                dashArray: 0,
            },
            plotOptions: {
                pie: {
                    expandOnClick: !1,
                    donut: {
                        size: "80%",
                        background: "transparent",
                        labels: {
                            show: !0,
                            name: {
                                show: !0,
                                fontSize: "20px",
                                color: "",
                                offsetY: -4,
                            },
                            value: {
                                show: !0,
                                fontSize: "18px",
                                color: void 0,
                                offsetY: 8,
                                formatter: function (r) {
                                    return r + "%";
                                },
                            },
                            total: {
                                show: !0,
                                showAlways: !0,
                                label: "Total",
                                fontSize: "22px",
                                fontWeight: 600,
                                color: "",
                            },
                        },
                    },
                },
            },
            colors: ["rgb(132, 90, 223)", "#23b7e5"],
        },
        At = new ApexCharts(document.querySelector("#candidates-chart"), Ie);
    At.render();
}
function lr(t) {
    At.updateOptions({ colors: ["rgb(" + t + ")", "#23b7e5"] });
}
var Y = document.getElementById("nft-balance-chart");
if (Y !== null) {
    Y.innerHTML = "";
    var ee = {
            chart: { type: "line", height: 40, sparkline: { enabled: !0 } },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 2.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 25, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            colors: ["rgb(132, 90, 223)"],
        },
        ee = new ApexCharts(document.querySelector("#nft-balance-chart"), ee);
    ee.render();
}
function nr(t) {
    ee.updateOptions({ colors: ["rgb(" + t + ")"] });
}
var Y = document.getElementById("nft-statistics");
if (Y !== null) {
    Y.innerHTML = "";
    var sr = {
            series: [
                {
                    name: "Price",
                    data: [20, 38, 38, 72, 55, 63, 43, 76, 55, 80, 40, 80],
                },
                {
                    name: "Volume",
                    data: [85, 65, 75, 38, 85, 35, 62, 40, 40, 64, 50, 89],
                },
            ],
            chart: {
                height: 350,
                type: "line",
                zoom: { enabled: !1 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 5,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            dataLabels: { enabled: !1 },
            legend: {
                position: "top",
                horizontalAlign: "center",
                offsetX: -15,
                fontWeight: "bold",
            },
            stroke: { curve: "smooth", width: "3", dashArray: [0, 5] },
            grid: { borderColor: "#f2f6f7" },
            colors: ["rgb(132, 90, 223)", "rgba(132, 90, 223, 0.3)"],
            yaxis: {
                title: {
                    text: "Statistics",
                    style: {
                        color: "#adb5be",
                        fontSize: "14px",
                        fontFamily: "poppins, sans-serif",
                        fontWeight: 600,
                        cssClass: "apexcharts-yaxis-label",
                    },
                },
                labels: {
                    formatter: function (t) {
                        return t.toFixed(0) + "";
                    },
                },
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: {
                    show: !0,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !0,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
        },
        Lt = new ApexCharts(document.querySelector("#nft-statistics"), sr);
    Lt.render();
}
function ir(t) {
    Lt.updateOptions({ colors: ["rgb(" + t + ")", "rgba(" + t + ", 0.3)"] });
}
typeof Swiper < "u" &&
    new Swiper(".pagination-dynamic", {
        pagination: {
            el: ".swiper-pagination",
            dynamicBullets: !0,
            clickable: !0,
        },
        loop: !0,
        autoplay: { delay: 1500, disableOnInteraction: !1 },
    });
var T = document.getElementById("salesOverview");
if (T !== null) {
    T.innerHTML = "";
    var Ee = {
            series: [
                {
                    name: "Sales",
                    data: [44, 42, 57, 86, 58, 55, 70, 43, 23, 54, 77, 34],
                },
                {
                    name: "OPEX Ratio",
                    data: [74, 72, 87, 116, 88, 85, 100, 73, 53, 84, 107, 64],
                },
                {
                    name: "General & Admin",
                    data: [84, 82, 97, 126, 98, 95, 110, 83, 63, 94, 117, 74],
                },
                {
                    name: "Marketing",
                    data: [
                        -34, -22, -37, -56, -21, -35, -60, -34, -56, -78, -89,
                        -53,
                    ],
                },
            ],
            chart: { stacked: !0, type: "bar", height: 325 },
            grid: { borderColor: "#f5f4f4", strokeDashArray: 5 },
            colors: [
                "rgb(132, 90, 223)",
                "rgba(132, 90, 223, 0.6)",
                "rgba(132, 90, 223, 0.3)",
                "#ebeff5",
            ],
            plotOptions: {
                bar: {
                    colors: {
                        ranges: [
                            { from: -100, to: -46, color: "#ebeff5" },
                            { from: -45, to: 0, color: "#ebeff5" },
                        ],
                    },
                    columnWidth: "20%",
                },
            },
            dataLabels: { enabled: !1 },
            legend: { show: !0, position: "top" },
            yaxis: {
                title: {
                    text: "Growth",
                    style: {
                        color: "#adb5be",
                        fontSize: "14px",
                        fontFamily: "Montserrat, sans-serif",
                        fontWeight: 600,
                        cssClass: "apexcharts-yaxis-label",
                    },
                },
                labels: {
                    formatter: function (t) {
                        return t.toFixed(0) + "";
                    },
                },
            },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "sep",
                    "oct",
                    "nov",
                    "dec",
                ],
                axisBorder: {
                    show: !1,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !1,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
        },
        Bt = new ApexCharts(document.querySelector("#salesOverview"), Ee);
    Bt.render();
}
function cr(t) {
    Bt.updateOptions({
        colors: [
            "rgb(" + t + ")",
            "rgba(" + t + ", 0.6)",
            "rgba(" + t + ", 0.3)",
            "#ebeff5",
        ],
    });
}
if (typeof jsVectorMap < "u") {
    var dr = [
            { name: "Usa", coords: [40.3, -101.38] },
            { name: "India", coords: [20.5937, 78.9629] },
            { name: "Vatican City", coords: [41.9, 12.45] },
            { name: "Canada", coords: [56.1304, -106.3468] },
            { name: "Mauritius", coords: [-20.2, 57.5] },
            { name: "Singapore", coords: [1.3, 103.8] },
            { name: "Palau", coords: [7.35, 134.46] },
            { name: "Maldives", coords: [3.2, 73.22] },
            { name: "São Tomé and Príncipe", coords: [0.33, 6.73] },
        ],
        T = document.getElementById("visitors-countries");
    T !== null &&
        ((T.innerHTML = ""),
        new jsVectorMap({
            map: "world_merc",
            selector: "#visitors-countries",
            markersSelectable: !0,
            zoomOnScroll: !1,
            zoomButtons: !1,
            onMarkerSelected(r, o, a) {
                console.log(r, o, a);
            },
            labels: {
                markers: {
                    render: function (r) {
                        return r.name;
                    },
                },
            },
            markers: dr,
            markerStyle: {
                hover: { stroke: "#DDD", strokeWidth: 3, fill: "#FFF" },
                selected: { fill: "#ff525d" },
            },
            markerLabelStyle: {
                initial: {
                    fontFamily: "Poppins",
                    fontSize: 13,
                    fontWeight: 500,
                    fill: "#35373e",
                },
            },
        }));
}
var T = document.getElementById("sale-value");
if (T !== null) {
    T.innerHTML = "";
    var Ee = {
            chart: { height: 230, type: "radialBar" },
            series: [60],
            colors: ["rgb(132, 90, 223)"],
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "70%", background: "#fff" },
                    track: {
                        dropShadow: {
                            enabled: !0,
                            top: 2,
                            left: 0,
                            blur: 2,
                            opacity: 0.15,
                        },
                    },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#845adf",
                            fontSize: "16px",
                            show: !1,
                        },
                        value: { color: "", fontSize: "30px", show: !0 },
                    },
                },
            },
            stroke: { lineCap: "round" },
            labels: ["Cart"],
        },
        It = new ApexCharts(document.querySelector("#sale-value"), Ee);
    It.render();
}
function ur(t) {
    It.updateOptions({ colors: ["rgb(" + t + ")"] });
}
var y = document.getElementById("analytics-users");
if (y !== null) {
    y.innerHTML = "";
    var be = {
            chart: {
                type: "line",
                height: 40,
                width: 120,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "straight",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [0, 21, 54, 38, 56, 24, 65] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#23b7e5"],
        },
        be = new ApexCharts(document.querySelector("#analytics-users"), be);
    be.render();
}
var y = document.getElementById("analytics-bouncerate");
if (y !== null) {
    y.innerHTML = "";
    var te = {
            chart: {
                type: "line",
                height: 45,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 1,
                    color: "#fff",
                    opacity: 0.05,
                },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 2,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [
                {
                    name: "Value",
                    data: [54, 38, 56, 35, 65, 43, 53, 45, 62, 80, 35, 48],
                },
            ],
            yaxis: { min: 0, show: !1 },
            xaxis: { axisBorder: { show: !1 } },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["rgba(132, 90, 223, 0.1)"],
            tooltip: { enabled: !1 },
        },
        te = new ApexCharts(
            document.querySelector("#analytics-bouncerate"),
            te
        );
    te.render();
}
function mr(t) {
    te.updateOptions({ colors: ["rgba(" + t + ", 0.1)"] });
}
var y = document.getElementById("sessions");
if (y !== null) {
    y.innerHTML = "";
    var D = {
            series: [1754, 1234, 878, 270],
            labels: ["Mobile", "Tablet", "Desktop", "Others"],
            chart: { height: 257, type: "donut" },
            dataLabels: { enabled: !1 },
            legend: { show: !1 },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "round",
                colors: "#fff",
                width: 0,
                dashArray: 0,
            },
            plotOptions: {
                pie: {
                    expandOnClick: !1,
                    donut: {
                        size: "80%",
                        background: "transparent",
                        labels: {
                            show: !0,
                            name: {
                                show: !0,
                                fontSize: "20px",
                                color: "#495057",
                                offsetY: -4,
                            },
                            value: {
                                show: !0,
                                fontSize: "18px",
                                color: void 0,
                                offsetY: 8,
                                formatter: function (t) {
                                    return t + "%";
                                },
                            },
                            total: {
                                show: !0,
                                showAlways: !0,
                                label: "Total",
                                fontSize: "22px",
                                fontWeight: 600,
                                color: "#495057",
                            },
                        },
                    },
                },
            },
            colors: [
                "rgba(132, 90, 223, 1)",
                "rgba(35, 183, 229, 1)",
                "rgba(38, 191, 148, 1)",
                "rgba(245, 184, 73, 1)",
            ],
        },
        Et = new ApexCharts(document.querySelector("#sessions"), D);
    Et.render();
}
function hr(t) {
    Et.updateOptions({
        colors: [
            "rgba(" + t + ", 1)",
            "rgba(35, 183, 229, 1)",
            "rgba(38, 191, 148, 1)",
            "rgba(245, 184, 73, 1)",
        ],
    });
}
var y = document.getElementById("audienceReport");
if (y !== null) {
    y.innerHTML = "";
    var D = {
            series: [
                {
                    name: "Views",
                    type: "column",
                    data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 45, 35],
                },
                {
                    name: "Followers",
                    type: "line",
                    data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43, 27],
                },
            ],
            chart: { toolbar: { show: !1 }, type: "line", height: 250 },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            dataLabels: { enabled: !1 },
            stroke: { width: [1, 1.1], curve: ["straight", "smooth"] },
            legend: { show: !0, position: "top" },
            xaxis: { axisBorder: { color: "#e9e9e9" } },
            plotOptions: { bar: { columnWidth: "20%", borderRadius: 2 } },
            colors: ["rgba(132, 90, 223, 1)", "#23b7e5"],
        },
        Ct = new ApexCharts(document.querySelector("#audienceReport"), D);
    Ct.render();
}
function yr(t) {
    Ct.updateOptions({ colors: ["rgba(" + t + ", 1)", "#23b7e5"] });
}
var y = document.getElementById("country-sessions");
if (y !== null) {
    y.innerHTML = "";
    var D = {
            series: [
                {
                    name: "Session",
                    data: [24, 23, 20, 25, 27, 26, 24, 23, 23, 25, 23, 23],
                    type: "line",
                },
                {
                    name: "Bounce Rate",
                    data: [20, 23, 26, 22, 20, 26, 28, 26, 22, 27, 25, 26],
                    type: "bar",
                },
            ],
            chart: { height: 330, zoom: { enabled: !1 } },
            dataLabels: { enabled: !1, show: !0 },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            legend: { show: !0, position: "top" },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    columnWidth: "40%",
                    dataLabels: { position: "top" },
                },
            },
            colors: ["rgb(132, 90, 223)", "#ededed"],
            stroke: {
                curve: ["smooth", "stepline"],
                width: [2, 0],
                columnWidth: "10%",
            },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                axisBorder: { color: "#e9e9e9" },
            },
        },
        Mt = new ApexCharts(document.querySelector("#country-sessions"), D);
    Mt.render();
}
function fr(t) {
    Mt.updateOptions({ colors: ["rgb(" + t + ")", "#ededed"] });
}
var y = document.getElementById("session-users");
if (y !== null) {
    y.innerHTML = "";
    var gr = {
            series: [
                {
                    name: "New Users",
                    data: [32, 15, 63, 51, 36, 62, 99, 42, 78, 76, 32, 120],
                },
                {
                    name: "Sessions",
                    data: [56, 58, 38, 50, 64, 45, 55, 32, 15, 63, 51, 136],
                },
                {
                    name: "Avg Session Duration",
                    data: [48, 29, 50, 69, 20, 59, 52, 12, 48, 28, 17, 98],
                },
            ],
            chart: {
                height: 420,
                type: "line",
                toolbar: { show: !1 },
                background: "none",
                fill: "#fff",
            },
            grid: { borderColor: "#f2f6f7" },
            colors: ["rgb(132, 90, 223)", "#23b7e5", "#f5b849"],
            background: "transparent",
            dataLabels: { enabled: !1 },
            stroke: { curve: "straight", width: 3 },
            dataLabels: { enabled: !1 },
            legend: { show: !0, position: "top" },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                show: !1,
                axisBorder: {
                    show: !1,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !1,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
            yaxis: {
                show: !1,
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
            tooltip: { x: { format: "dd/MM/yy HH:mm" } },
        },
        Dt = new ApexCharts(document.querySelector("#session-users"), gr);
    Dt.render();
}
function pr(t) {
    Dt.updateOptions({ colors: ["rgb(" + t + ")", "#23b7e5", "#f5b849"] });
}
var y = document.getElementById("analytics-followers");
if (y !== null) {
    y.innerHTML = "";
    var D = {
            chart: { height: 120, width: 100, type: "radialBar" },
            series: [48],
            colors: ["#23b7e5"],
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%", background: "#fff" },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#23b7e5",
                            fontSize: "10px",
                            show: !1,
                        },
                        value: {
                            offsetY: 5,
                            color: "#23b7e5",
                            fontSize: "12px",
                            show: !0,
                            fontWeight: 800,
                        },
                    },
                },
            },
            stroke: { lineCap: "round" },
            labels: ["Followers"],
        },
        br = new ApexCharts(document.querySelector("#analytics-followers"), D);
    br.render();
}
var y = document.getElementById("analytics-views");
if (y !== null) {
    y.innerHTML = "";
    var D = {
            chart: { height: 120, width: 100, type: "radialBar" },
            series: [65],
            colors: ["#f7b731"],
            plotOptions: {
                radialBar: {
                    hollow: { margin: 0, size: "50%", background: "#fff" },
                    dataLabels: {
                        name: {
                            offsetY: -10,
                            color: "#f7b731",
                            fontSize: "10px",
                            show: !1,
                        },
                        value: {
                            offsetY: 5,
                            color: "#f7b731",
                            fontSize: "12px",
                            show: !0,
                            fontWeight: 800,
                        },
                    },
                },
            },
            stroke: { lineCap: "round" },
            labels: ["Views"],
        },
        wr = new ApexCharts(document.querySelector("#analytics-views"), D);
    wr.render();
}
var S = document.getElementById("projectAnalysis");
if (S !== null) {
    S.innerHTML = "";
    var vr = {
            series: [
                {
                    name: "Projects",
                    type: "column",
                    data: [1.8, 2.5, 2.5, 1.5, 2.5, 2.8, 3.8],
                },
                {
                    name: "Tasks",
                    type: "column",
                    data: [1.1, 2.2, 3.1, 4, 4.1, 4.9, 6.5],
                },
                {
                    name: "Revenue",
                    type: "line",
                    data: [20, 29, 37, 35, 44, 43, 50],
                },
            ],
            chart: {
                toolbar: { show: !1 },
                height: 315,
                type: "line",
                stacked: !1,
                fontFamily: "Poppins, Arial, sans-serif",
            },
            grid: { borderColor: "#f5f4f4", strokeDashArray: 3 },
            dataLabels: { enabled: !1 },
            title: { text: void 0 },
            xaxis: {
                categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            },
            yaxis: [
                {
                    show: !0,
                    axisTicks: { show: !0 },
                    axisBorder: { show: !1, color: "#4eb6d0" },
                    labels: { style: { colors: "#4eb6d0" } },
                    title: { text: void 0 },
                    tooltip: { enabled: !0 },
                },
                {
                    seriesName: "Projects",
                    opposite: !0,
                    axisTicks: { show: !0 },
                    axisBorder: { show: !1 },
                    labels: { style: { colors: "#00E396" } },
                    title: { text: void 0 },
                },
                {
                    seriesName: "Revenue",
                    opposite: !0,
                    axisTicks: { show: !0 },
                    axisBorder: { show: !1 },
                    labels: { show: !1 },
                    title: { text: void 0 },
                },
            ],
            tooltip: { enabled: !0 },
            legend: {
                show: !0,
                position: "top",
                offsetX: 40,
                fontSize: "13px",
                fontWeight: "normal",
                labels: { colors: "#acb1b1" },
                markers: { width: 10, height: 10 },
            },
            stroke: {
                width: [0, 0, 1.5],
                curve: "straight",
                dashArray: [0, 0, 0],
            },
            plotOptions: { bar: { columnWidth: "35%", borderRadius: 3 } },
            colors: ["rgb(132, 90, 223)", "#ededed", "#23b7e5"],
        },
        Tt = new ApexCharts(document.querySelector("#projectAnalysis"), vr);
    Tt.render();
}
function Sr(t) {
    Tt.updateOptions({ colors: ["rgb(" + t + ")", "#ededed", "#23b7e5"] });
}
var S = document.getElementById("user1");
if (S !== null) {
    S.innerHTML = "";
    var we = {
            chart: {
                type: "line",
                height: 20,
                width: 80,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [54, 38, 56, 24, 65] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#09ad95"],
        },
        we = new ApexCharts(document.querySelector("#user1"), we);
    we.render();
}
var S = document.getElementById("user2");
if (S !== null) {
    S.innerHTML = "";
    var ve = {
            chart: {
                type: "line",
                height: 20,
                width: 80,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [24, 54, 15, 42, 16] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#fb6b27"],
        },
        ve = new ApexCharts(document.querySelector("#user2"), ve);
    ve.render();
}
var S = document.getElementById("user3");
if (S !== null) {
    S.innerHTML = "";
    var Se = {
            chart: {
                type: "line",
                height: 20,
                width: 80,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [15, 42, 16, 44, 24] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#1170e4"],
        },
        Se = new ApexCharts(document.querySelector("#user3"), Se);
    Se.render();
}
var S = document.getElementById("user4");
if (S !== null) {
    S.innerHTML = "";
    var xe = {
            chart: {
                type: "line",
                height: 20,
                width: 80,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [54, 38, 56, 24, 65] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#e82646"],
        },
        xe = new ApexCharts(document.querySelector("#user4"), xe);
    xe.render();
}
var S = document.getElementById("user5");
if (S !== null) {
    S.innerHTML = "";
    var ke = {
            chart: {
                type: "line",
                height: 20,
                width: 80,
                sparkline: { enabled: !0 },
                dropShadow: {
                    enabled: !0,
                    enabledOnSeries: void 0,
                    top: 0,
                    left: 0,
                    blur: 3,
                    color: "#000",
                    opacity: 0.1,
                },
            },
            grid: {
                show: !1,
                xaxis: { lines: { show: !1 } },
                yaxis: { lines: { show: !1 } },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: { gradient: { enabled: !1 } },
            series: [{ name: "Value", data: [15, 42, 16, 44, 24] }],
            yaxis: { min: 0, show: !1 },
            xaxis: {
                show: !1,
                axisTicks: { show: !1 },
                axisBorder: { show: !1 },
            },
            yaxis: { axisBorder: { show: !1 } },
            colors: ["#f7b731"],
        },
        ke = new ApexCharts(document.querySelector("#user5"), ke);
    ke.render();
}
var _ = document.getElementById("performanceReport");
if (_ !== null) {
    _.innerHTML = "";
    var Ce = {
            series: [
                {
                    name: "Designing",
                    data: [44, 55, 41, 67, 22, 43, 44, 55, 41, 67, 22, 43],
                },
                {
                    name: "Development",
                    data: [13, 23, 20, 8, 13, 27, 13, 23, 20, 8, 13, 27],
                },
                {
                    name: "SEO",
                    data: [11, 17, 15, 15, 21, 14, 11, 17, 15, 15, 21, 14],
                },
            ],
            chart: {
                type: "bar",
                height: 310,
                stacked: !0,
                toolbar: { show: !0 },
                zoom: { enabled: !0 },
            },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: "bottom",
                            offsetX: -10,
                            offsetY: 0,
                        },
                    },
                },
            ],
            colors: [
                "rgba(132, 90, 223, 1)",
                "rgba(132, 90, 223, 0.5)",
                "rgba(132, 90, 223, 0.2)",
            ],
            legend: { show: !1, position: "top" },
            plotOptions: { bar: { columnWidth: "20%" } },
            dataLabels: { enabled: !1 },
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            fill: { opacity: 1 },
        },
        Rt = new ApexCharts(document.querySelector("#performanceReport"), Ce);
    Rt.render();
}
function xr(t) {
    Rt.updateOptions({
        colors: [
            "rgba(" + t + ", 1)",
            "rgba(" + t + ", 0.5)",
            "rgba(" + t + ", 0.2)",
        ],
    });
}
var _ = document.getElementById("jobs-summary");
if (_ !== null) {
    _.innerHTML = "";
    var Ce = {
            series: [1754, 544, 682, 263],
            labels: ["Published", "Private", "Closed", "On Hold"],
            chart: { height: 250, type: "donut" },
            dataLabels: { enabled: !1 },
            legend: { show: !1 },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "round",
                colors: "#fff",
                width: 0,
                dashArray: 0,
            },
            plotOptions: {
                pie: {
                    expandOnClick: !1,
                    donut: {
                        size: "70%",
                        background: "transparent",
                        labels: {
                            show: !0,
                            name: {
                                show: !0,
                                fontSize: "20px",
                                color: "#495057",
                                offsetY: -4,
                            },
                            value: {
                                show: !0,
                                fontSize: "18px",
                                color: void 0,
                                offsetY: 8,
                                formatter: function (r) {
                                    return r + "%";
                                },
                            },
                            total: {
                                show: !0,
                                showAlways: !0,
                                label: "Total",
                                fontSize: "22px",
                                fontWeight: 600,
                                color: "#495057",
                            },
                        },
                    },
                },
            },
            colors: [
                "rgb(132, 90, 223)",
                "rgba(132, 90, 223, 0.7)",
                "rgba(132, 90, 223,0.4)",
                "rgb(243, 246, 248)",
            ],
        },
        Pt = new ApexCharts(document.querySelector("#jobs-summary"), Ce);
    Pt.render();
}
function kr(t) {
    Pt.updateOptions({
        colors: [
            "rgb(" + t + ")",
            "rgba(" + t + ", 0.7)",
            "rgba(" + t + ", 0.4)",
            "rgb(243, 246, 248)",
        ],
    });
}
var x = document.getElementById("total-invested");
if (x !== null) {
    x.innerHTML = "";
    var re = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 23, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(132, 90, 223)"],
        },
        re = new ApexCharts(document.querySelector("#total-invested"), re);
    re.render();
}
function qr(t) {
    function r(o, a, l) {
        return (
            "#" + ((1 << 24) | (o << 16) | (a << 8) | l).toString(16).slice(1)
        );
    }
    re.updateOptions({
        colors: [r(t.split(",")[0], t.split(",")[1], t.split(",")[2])],
    });
}
var x = document.getElementById("total-investments");
if (x !== null) {
    x.innerHTML = "";
    var qe = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 23, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(14, 168, 186)"],
        },
        qe = new ApexCharts(document.querySelector("#total-investments"), qe);
    qe.render();
}
var x = document.getElementById("portfolio-value");
if (x !== null) {
    x.innerHTML = "";
    var Ae = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 23, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(245, 184, 73)"],
        },
        Ae = new ApexCharts(document.querySelector("#portfolio-value"), Ae);
    Ae.render();
}
var x = document.getElementById("returns-rate");
if (x !== null) {
    x.innerHTML = "";
    var Le = {
            chart: {
                type: "line",
                height: 40,
                width: 100,
                sparkline: { enabled: !0 },
            },
            stroke: {
                show: !0,
                curve: "smooth",
                lineCap: "butt",
                colors: void 0,
                width: 1.5,
                dashArray: 0,
            },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.9, opacityTo: 0.9, stops: [0, 98] },
            },
            series: [
                { name: "Value", data: [20, 14, 19, 10, 23, 20, 22, 9, 12] },
            ],
            yaxis: { min: 0, show: !1, axisBorder: { show: !1 } },
            xaxis: { show: !1, axisBorder: { show: !1 } },
            tooltip: { enabled: !1 },
            colors: ["rgb(38, 191, 148)"],
        },
        Le = new ApexCharts(document.querySelector("#returns-rate"), Le);
    Le.render();
}
var x = document.getElementById("totalInvestmentsStats");
if (x !== null) {
    x.innerHTML = "";
    var Me = {
            series: [
                {
                    name: "Invested",
                    data: [
                        [13273596e5, 30.95],
                        [1327446e6, 31.34],
                        [13275324e5, 31.18],
                        [13276188e5, 31.05],
                        [1327878e6, 31],
                        [13279644e5, 30.95],
                        [13280508e5, 31.24],
                        [13281372e5, 31.29],
                        [13282236e5, 31.85],
                        [13284828e5, 31.86],
                        [13285692e5, 32.28],
                        [13286556e5, 32.1],
                        [1328742e6, 32.65],
                        [13288284e5, 32.21],
                        [13290876e5, 32.35],
                        [1329174e6, 32.44],
                        [13292604e5, 32.46],
                        [13293468e5, 32.86],
                        [13294332e5, 32.75],
                        [13297788e5, 32.54],
                        [13298652e5, 32.33],
                        [13299516e5, 32.97],
                        [1330038e6, 33.41],
                        [13302972e5, 33.27],
                        [13303836e5, 33.27],
                        [133047e7, 32.89],
                        [13305564e5, 33.1],
                        [13306428e5, 33.73],
                        [1330902e6, 33.22],
                        [13309884e5, 31.99],
                        [13310748e5, 32.41],
                        [13311612e5, 33.05],
                        [13312476e5, 33.64],
                        [13315068e5, 33.56],
                        [13315932e5, 34.22],
                        [13316796e5, 33.77],
                        [1331766e6, 34.17],
                        [13318524e5, 33.82],
                        [13321116e5, 34.51],
                        [1332198e6, 33.16],
                        [13322844e5, 33.56],
                        [13323708e5, 33.71],
                        [13324572e5, 33.81],
                        [13327128e5, 34.4],
                        [13327992e5, 34.63],
                        [13328856e5, 34.46],
                        [1332972e6, 34.48],
                        [13330584e5, 34.31],
                        [13333176e5, 34.7],
                        [1333404e6, 34.31],
                        [13334904e5, 33.46],
                        [13335768e5, 33.59],
                        [13339224e5, 33.22],
                        [13340088e5, 32.61],
                        [13340952e5, 33.01],
                        [13341816e5, 33.55],
                        [1334268e6, 33.18],
                        [13345272e5, 32.84],
                        [13346136e5, 33.84],
                        [13347e8, 33.39],
                        [13347864e5, 32.91],
                        [13348728e5, 33.06],
                        [1335132e6, 32.62],
                        [13352184e5, 32.4],
                        [13353048e5, 33.13],
                        [13353912e5, 33.26],
                        [13354776e5, 33.58],
                        [13357368e5, 33.55],
                        [13358232e5, 33.77],
                        [13359096e5, 33.76],
                        [1335996e6, 33.32],
                        [13360824e5, 32.61],
                        [13363416e5, 32.52],
                        [1336428e6, 32.67],
                        [13365144e5, 32.52],
                        [13366008e5, 31.92],
                        [13366872e5, 32.2],
                        [13369464e5, 32.23],
                        [13370328e5, 32.33],
                        [13371192e5, 32.36],
                        [13372056e5, 32.01],
                        [1337292e6, 31.31],
                        [13375512e5, 32.01],
                        [13376376e5, 32.01],
                        [1337724e6, 32.18],
                        [13378104e5, 31.54],
                        [13378968e5, 31.6],
                        [13382424e5, 32.05],
                        [13383288e5, 31.29],
                        [13384152e5, 31.05],
                        [13385016e5, 29.82],
                        [13387608e5, 30.31],
                        [13388472e5, 30.7],
                        [13389336e5, 31.69],
                        [133902e7, 31.32],
                        [13391064e5, 31.65],
                        [13393656e5, 31.13],
                        [1339452e6, 31.77],
                        [13395384e5, 31.79],
                        [13396248e5, 31.67],
                        [13397112e5, 32.39],
                        [13399704e5, 32.63],
                        [13400568e5, 32.89],
                        [13401432e5, 31.99],
                        [13402296e5, 31.23],
                        [1340316e6, 31.57],
                        [13405752e5, 30.84],
                        [13406616e5, 31.07],
                        [1340748e6, 31.41],
                        [13408344e5, 31.17],
                        [13409208e5, 32.37],
                        [134118e7, 32.19],
                        [13412664e5, 32.51],
                        [13414392e5, 32.53],
                        [13415256e5, 31.37],
                        [13417848e5, 30.43],
                        [13418712e5, 30.44],
                        [13419576e5, 30.2],
                        [1342044e6, 30.14],
                        [13421304e5, 30.65],
                        [13423896e5, 30.4],
                        [1342476e6, 30.65],
                        [13425624e5, 31.43],
                        [13426488e5, 31.89],
                        [13427352e5, 31.38],
                        [13429944e5, 30.64],
                        [13430808e5, 30.02],
                        [13431672e5, 30.33],
                        [13432536e5, 30.95],
                        [134334e7, 31.89],
                        [13435992e5, 31.01],
                        [13436856e5, 30.88],
                        [1343772e6, 30.69],
                        [13438584e5, 30.58],
                        [13439448e5, 32.02],
                        [1344204e6, 32.14],
                        [13442904e5, 32.37],
                        [13443768e5, 32.51],
                        [13444632e5, 32.65],
                        [13445496e5, 32.64],
                        [13448088e5, 32.27],
                        [13448952e5, 32.1],
                        [13449816e5, 32.91],
                        [1345068e6, 33.65],
                        [13451544e5, 33.8],
                        [13454136e5, 33.92],
                        [13455e8, 33.75],
                        [13455864e5, 33.84],
                        [13456728e5, 33.5],
                        [13457592e5, 32.26],
                        [13460184e5, 32.32],
                        [13461048e5, 32.06],
                        [13461912e5, 31.96],
                        [13462776e5, 31.46],
                        [1346364e6, 31.27],
                        [13467096e5, 31.43],
                        [1346796e6, 32.26],
                        [13468824e5, 32.79],
                        [13469688e5, 32.46],
                        [1347228e6, 32.13],
                        [13473144e5, 32.43],
                        [13474008e5, 32.42],
                        [13474872e5, 32.81],
                        [13475736e5, 33.34],
                        [13478328e5, 33.41],
                        [13479192e5, 32.57],
                        [13480056e5, 33.12],
                        [1348092e6, 34.53],
                        [13481784e5, 33.83],
                        [13484376e5, 33.41],
                        [1348524e6, 32.9],
                        [13486104e5, 32.53],
                        [13486968e5, 32.8],
                        [13487832e5, 32.44],
                        [13490424e5, 32.62],
                        [13491288e5, 32.57],
                        [13492152e5, 32.6],
                        [13493016e5, 32.68],
                        [1349388e6, 32.47],
                        [13496472e5, 32.23],
                        [13497336e5, 31.68],
                        [134982e7, 31.51],
                        [13499064e5, 31.78],
                        [13499928e5, 31.94],
                        [1350252e6, 32.33],
                        [13503384e5, 33.24],
                        [13504248e5, 33.44],
                        [13505112e5, 33.48],
                        [13505976e5, 33.24],
                        [13508568e5, 33.49],
                        [13509432e5, 33.31],
                        [13510296e5, 33.36],
                        [1351116e6, 33.4],
                        [13512024e5, 34.01],
                        [1351638e6, 34.02],
                        [13517244e5, 34.36],
                        [13518108e5, 34.39],
                        [135207e7, 34.24],
                        [13521564e5, 34.39],
                        [13522428e5, 33.47],
                        [13523292e5, 32.98],
                        [13524156e5, 32.9],
                        [13526748e5, 32.7],
                        [13527612e5, 32.54],
                        [13528476e5, 32.23],
                        [1352934e6, 32.64],
                        [13530204e5, 32.65],
                        [13532796e5, 32.92],
                        [1353366e6, 32.64],
                        [13534524e5, 32.84],
                        [13536252e5, 33.4],
                        [13538844e5, 33.3],
                        [13539708e5, 33.18],
                        [13540572e5, 33.88],
                        [13541436e5, 34.09],
                        [135423e7, 34.61],
                        [13544892e5, 34.7],
                        [13545756e5, 35.3],
                        [1354662e6, 35.4],
                        [13547484e5, 35.14],
                        [13548348e5, 35.48],
                        [1355094e6, 35.75],
                        [13551804e5, 35.54],
                        [13552668e5, 35.96],
                        [13553532e5, 35.53],
                        [13554396e5, 37.56],
                        [13556988e5, 37.42],
                        [13557852e5, 37.49],
                        [13558716e5, 38.09],
                        [1355958e6, 37.87],
                        [13560444e5, 37.71],
                        [13563036e5, 37.53],
                        [13564764e5, 37.55],
                        [13565628e5, 37.3],
                        [13566492e5, 36.9],
                        [13569084e5, 37.68],
                        [13570812e5, 38.34],
                        [13571676e5, 37.75],
                        [1357254e6, 38.13],
                        [13575132e5, 37.94],
                        [13575996e5, 38.14],
                        [1357686e6, 38.66],
                        [13577724e5, 38.62],
                        [13578588e5, 38.09],
                        [1358118e6, 38.16],
                        [13582044e5, 38.15],
                        [13582908e5, 37.88],
                        [13583772e5, 37.73],
                        [13584636e5, 37.98],
                        [13588092e5, 37.95],
                        [13588956e5, 38.25],
                        [1358982e6, 38.1],
                        [13590684e5, 38.32],
                        [13593276e5, 38.24],
                        [1359414e6, 38.52],
                        [13595004e5, 37.94],
                        [13595868e5, 37.83],
                        [13596732e5, 38.34],
                        [13599324e5, 38.1],
                        [13600188e5, 38.51],
                        [13601052e5, 38.4],
                        [13601916e5, 38.07],
                        [1360278e6, 39.12],
                        [13605372e5, 38.64],
                        [13606236e5, 38.89],
                        [136071e7, 38.81],
                        [13607964e5, 38.61],
                        [13608828e5, 38.63],
                        [13612284e5, 38.99],
                        [13613148e5, 38.77],
                        [13614012e5, 38.34],
                        [13614876e5, 38.55],
                        [13617468e5, 38.11],
                        [13618332e5, 38.59],
                        [13619196e5, 39.6],
                    ],
                },
            ],
            chart: {
                id: "area-datetime",
                fontFamily: "Roboto, Arial, sans-serif",
                type: "area",
                height: 320,
                zoom: { autoScaleYaxis: !0 },
                toolbar: { show: !1 },
            },
            grid: { borderColor: "#f3f3f3", strokeDashArray: 3 },
            dataLabels: { enabled: !1 },
            markers: { size: 0, style: "hollow" },
            xaxis: {
                type: "datetime",
                min: new Date("01 Mar 2012").getTime(),
                tickAmount: 6,
            },
            tooltip: { x: { format: "dd MMM yyyy" } },
            colors: ["rgb(132, 90, 223)"],
            stroke: { width: [1.2], curve: ["smooth"] },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.5,
                    opacityTo: 0.7,
                    stops: [0, 100],
                },
            },
        },
        Ot = new ApexCharts(
            document.querySelector("#totalInvestmentsStats"),
            Me
        );
    Ot.render();
}
function Ar(t) {
    function r(o, a, l) {
        return (
            "#" + ((1 << 24) | (o << 16) | (a << 8) | l).toString(16).slice(1)
        );
    }
    Ot.updateOptions({
        colors: [r(t.split(",")[0], t.split(",")[1], t.split(",")[2])],
    });
}
var x = document.getElementById("stocks-marketcap");
if (x !== null) {
    x.innerHTML = "";
    var Me = {
            series: [
                {
                    data: [
                        {
                            x: new Date(15387786e5),
                            y: [6629.81, 6650.5, 6623.04, 6633.33],
                        },
                        {
                            x: new Date(15387804e5),
                            y: [6632.01, 6643.59, 6620, 6630.11],
                        },
                        {
                            x: new Date(15387822e5),
                            y: [6630.71, 6648.95, 6623.34, 6635.65],
                        },
                        {
                            x: new Date(1538784e6),
                            y: [6635.65, 6651, 6629.67, 6638.24],
                        },
                        {
                            x: new Date(15387858e5),
                            y: [6638.24, 6640, 6620, 6624.47],
                        },
                        {
                            x: new Date(15387876e5),
                            y: [6624.53, 6636.03, 6621.68, 6624.31],
                        },
                        {
                            x: new Date(15387894e5),
                            y: [6624.61, 6632.2, 6617, 6626.02],
                        },
                        {
                            x: new Date(15387912e5),
                            y: [6627, 6627.62, 6584.22, 6603.02],
                        },
                        {
                            x: new Date(1538793e6),
                            y: [6605, 6608.03, 6598.95, 6604.01],
                        },
                        {
                            x: new Date(15387948e5),
                            y: [6604.5, 6614.4, 6602.26, 6608.02],
                        },
                        {
                            x: new Date(15387966e5),
                            y: [6608.02, 6610.68, 6601.99, 6608.91],
                        },
                        {
                            x: new Date(15387984e5),
                            y: [6608.91, 6618.99, 6608.01, 6612],
                        },
                        {
                            x: new Date(15388002e5),
                            y: [6612, 6615.13, 6605.09, 6612],
                        },
                        {
                            x: new Date(1538802e6),
                            y: [6612, 6624.12, 6608.43, 6622.95],
                        },
                        {
                            x: new Date(15388038e5),
                            y: [6623.91, 6623.91, 6615, 6615.67],
                        },
                        {
                            x: new Date(15388056e5),
                            y: [6618.69, 6618.74, 6610, 6610.4],
                        },
                        {
                            x: new Date(15388074e5),
                            y: [6611, 6622.78, 6610.4, 6614.9],
                        },
                        {
                            x: new Date(15388092e5),
                            y: [6614.9, 6626.2, 6613.33, 6623.45],
                        },
                        {
                            x: new Date(1538811e6),
                            y: [6623.48, 6627, 6618.38, 6620.35],
                        },
                        {
                            x: new Date(15388128e5),
                            y: [6619.43, 6620.35, 6610.05, 6615.53],
                        },
                        {
                            x: new Date(15388146e5),
                            y: [6615.53, 6617.93, 6610, 6615.19],
                        },
                        {
                            x: new Date(15388164e5),
                            y: [6615.19, 6621.6, 6608.2, 6620],
                        },
                        {
                            x: new Date(15388182e5),
                            y: [6619.54, 6625.17, 6614.15, 6620],
                        },
                        {
                            x: new Date(153882e7),
                            y: [6620.33, 6634.15, 6617.24, 6624.61],
                        },
                        {
                            x: new Date(15388218e5),
                            y: [6625.95, 6626, 6611.66, 6617.58],
                        },
                        {
                            x: new Date(15388236e5),
                            y: [6619, 6625.97, 6595.27, 6598.86],
                        },
                        {
                            x: new Date(15388254e5),
                            y: [6598.86, 6598.88, 6570, 6587.16],
                        },
                        {
                            x: new Date(15388272e5),
                            y: [6588.86, 6600, 6580, 6593.4],
                        },
                        {
                            x: new Date(1538829e6),
                            y: [6593.99, 6598.89, 6585, 6587.81],
                        },
                        {
                            x: new Date(15388308e5),
                            y: [6587.81, 6592.73, 6567.14, 6578],
                        },
                        {
                            x: new Date(15388326e5),
                            y: [6578.35, 6581.72, 6567.39, 6579],
                        },
                        {
                            x: new Date(15388344e5),
                            y: [6579.38, 6580.92, 6566.77, 6575.96],
                        },
                        {
                            x: new Date(15388362e5),
                            y: [6575.96, 6589, 6571.77, 6588.92],
                        },
                        {
                            x: new Date(1538838e6),
                            y: [6588.92, 6594, 6577.55, 6589.22],
                        },
                        {
                            x: new Date(15388398e5),
                            y: [6589.3, 6598.89, 6589.1, 6596.08],
                        },
                        {
                            x: new Date(15388416e5),
                            y: [6597.5, 6600, 6588.39, 6596.25],
                        },
                        {
                            x: new Date(15388434e5),
                            y: [6598.03, 6600, 6588.73, 6595.97],
                        },
                        {
                            x: new Date(15388452e5),
                            y: [6595.97, 6602.01, 6588.17, 6602],
                        },
                        {
                            x: new Date(1538847e6),
                            y: [6602, 6607, 6596.51, 6599.95],
                        },
                        {
                            x: new Date(15388488e5),
                            y: [6600.63, 6601.21, 6590.39, 6591.02],
                        },
                        {
                            x: new Date(15388506e5),
                            y: [6591.02, 6603.08, 6591, 6591],
                        },
                        {
                            x: new Date(15388524e5),
                            y: [6591, 6601.32, 6585, 6592],
                        },
                        {
                            x: new Date(15388542e5),
                            y: [6593.13, 6596.01, 6590, 6593.34],
                        },
                        {
                            x: new Date(1538856e6),
                            y: [6593.34, 6604.76, 6582.63, 6593.86],
                        },
                        {
                            x: new Date(15388578e5),
                            y: [6593.86, 6604.28, 6586.57, 6600.01],
                        },
                        {
                            x: new Date(15388596e5),
                            y: [6601.81, 6603.21, 6592.78, 6596.25],
                        },
                        {
                            x: new Date(15388614e5),
                            y: [6596.25, 6604.2, 6590, 6602.99],
                        },
                        {
                            x: new Date(15388632e5),
                            y: [6602.99, 6606, 6584.99, 6587.81],
                        },
                        {
                            x: new Date(1538865e6),
                            y: [6587.81, 6595, 6583.27, 6591.96],
                        },
                        {
                            x: new Date(15388668e5),
                            y: [6591.97, 6596.07, 6585, 6588.39],
                        },
                        {
                            x: new Date(15388686e5),
                            y: [6587.6, 6598.21, 6587.6, 6594.27],
                        },
                        {
                            x: new Date(15388704e5),
                            y: [6596.44, 6601, 6590, 6596.55],
                        },
                        {
                            x: new Date(15388722e5),
                            y: [6598.91, 6605, 6596.61, 6600.02],
                        },
                        {
                            x: new Date(1538874e6),
                            y: [6600.55, 6605, 6589.14, 6593.01],
                        },
                        {
                            x: new Date(15388758e5),
                            y: [6593.15, 6605, 6592, 6603.06],
                        },
                        {
                            x: new Date(15388776e5),
                            y: [6603.07, 6604.5, 6599.09, 6603.89],
                        },
                        {
                            x: new Date(15388794e5),
                            y: [6604.44, 6604.44, 6600, 6603.5],
                        },
                        {
                            x: new Date(15388812e5),
                            y: [6603.5, 6603.99, 6597.5, 6603.86],
                        },
                        {
                            x: new Date(1538883e6),
                            y: [6603.85, 6605, 6600, 6604.07],
                        },
                        {
                            x: new Date(15388848e5),
                            y: [6604.98, 6606, 6604.07, 6606],
                        },
                    ],
                },
            ],
            chart: {
                type: "candlestick",
                borderRadius: 20,
                height: 350,
                toolbar: { show: !1 },
            },
            plotOptions: {
                candlestick: {
                    colors: {
                        upward: "rgb(132, 90, 223)",
                        downward: "rgb(35, 183, 229)",
                    },
                },
            },
            title: { align: "left" },
            grid: { borderColor: "#f1f1f1", strokeDashArray: 3 },
            xaxis: {
                type: "datetime",
                axisBorder: {
                    show: !1,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !1,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
            },
            yaxis: { tooltip: { enabled: !0 } },
        },
        Ht = new ApexCharts(document.querySelector("#stocks-marketcap"), Me);
    Ht.render();
}
function Lr(t) {
    function r(o, a, l) {
        return (
            "#" + ((1 << 24) | (o << 16) | (a << 8) | l).toString(16).slice(1)
        );
    }
    Ht.updateOptions({
        plotOptions: {
            candlestick: {
                colors: {
                    upward: r(
                        t.split(",")[0],
                        t.split(",")[1],
                        t.split(",")[2]
                    ),
                    downward: "rgb(35, 183, 229)",
                },
            },
        },
    });
}
var X = document.getElementById("courses-earnings");
if (X !== null) {
    X.innerHTML = "";
    var Br = {
            series: [
                {
                    name: "Earnings",
                    data: [30, 25, 36, 30, 45, 35, 64, 51, 59, 36, 39, 51],
                },
                {
                    name: "Students",
                    data: [33, 21, 32, 37, 23, 32, 47, 31, 54, 32, 20, 38],
                },
            ],
            chart: { height: 340, type: "bar" },
            dataLabels: { enabled: !1 },
            stroke: {
                width: [1.1, 1.1],
                show: !0,
                curve: ["smooth", "smooth"],
            },
            grid: { borderColor: "#f3f3f3", strokeDashArray: 3 },
            xaxis: { axisBorder: { color: "rgba(119, 119, 142, 0.05)" } },
            legend: { show: !1 },
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            markers: { size: 0 },
            colors: ["rgb(132, 90, 223)", "#e9e9e9"],
            plotOptions: { bar: { columnWidth: "50%", borderRadius: 2 } },
        },
        Ft = new ApexCharts(document.querySelector("#courses-earnings"), Br);
    Ft.render();
}
function Ir(t) {
    Ft.updateOptions({ colors: ["rgb(" + t + ")", "#e9e9e9"] });
}
var X = document.getElementById("course-payouts");
if (X !== null) {
    X.innerHTML = "";
    var Er = {
            series: [
                {
                    name: "Paid",
                    data: [55, 55, 42, 42, 55, 55, 38, 38, 53, 53, 35, 35],
                    type: "line",
                },
                {
                    name: "UnPaid",
                    data: [35, 35, 46, 46, 35, 35, 48, 48, 33, 33, 38, 38],
                    type: "line",
                },
            ],
            chart: {
                height: 265,
                toolbar: { show: !1 },
                background: "none",
                fill: "#fff",
            },
            grid: { borderColor: "#f2f6f7" },
            colors: ["rgb(132, 90, 223)", "rgba(230, 83, 60,0.5)"],
            background: "transparent",
            dataLabels: { enabled: !1 },
            stroke: { curve: "smooth", width: 2, dashArray: [0, 5] },
            xaxis: {
                type: "month",
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            dataLabels: { enabled: !1 },
            legend: { show: !0, position: "top" },
            xaxis: {
                show: !1,
                axisBorder: {
                    show: !1,
                    color: "rgba(119, 119, 142, 0.05)",
                    offsetX: 0,
                    offsetY: 0,
                },
                axisTicks: {
                    show: !1,
                    borderType: "solid",
                    color: "rgba(119, 119, 142, 0.05)",
                    width: 6,
                    offsetX: 0,
                    offsetY: 0,
                },
                labels: { rotate: -90 },
            },
            yaxis: {
                show: !1,
                axisBorder: { show: !1 },
                axisTicks: { show: !1 },
            },
            tooltip: { x: { format: "dd/MM/yy HH:mm" } },
        },
        $t = new ApexCharts(document.querySelector("#course-payouts"), Er);
    $t.render();
}
function Cr(t) {
    $t.updateOptions({ colors: ["rgb(" + t + ")", "rgba(230, 83, 60,0.5)"] });
}
var j = document.getElementById("waterTrack");
if (j !== null) {
    j.innerHTML = "";
    var De = {
            series: [{ data: [98, 110, 80, 145, 105, 112, 87, 148, 102] }],
            chart: {
                height: 115,
                type: "area",
                fontFamily: "Roboto, Arial, sans-serif",
                foreColor: "#5d6162",
                zoom: { enabled: !1 },
                sparkline: { enabled: !0 },
            },
            tooltip: {
                enabled: !0,
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (t) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
            dataLabels: { enabled: !1 },
            stroke: { curve: "straight" },
            title: { text: void 0 },
            grid: { borderColor: "transparent" },
            xaxis: { crosshairs: { show: !1 } },
            colors: ["rgb(132, 90, 223)"],
            stroke: { width: [1] },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.5, opacityTo: 0.2, stops: [0, 60] },
            },
        },
        zt = new ApexCharts(document.querySelector("#waterTrack"), De);
    zt.render();
}
function Mr(t) {
    function r(o, a, l) {
        return (
            "#" + ((1 << 24) | (o << 16) | (a << 8) | l).toString(16).slice(1)
        );
    }
    zt.updateOptions({
        colors: [r(t.split(",")[0], t.split(",")[1], t.split(",")[2])],
    });
}
var j = document.getElementById("sleepTrack");
if (j !== null) {
    j.innerHTML = "";
    var De = {
            series: [{ data: [102, 148, 87, 112, 105, 145, 80, 110, 98] }],
            chart: {
                height: 115,
                type: "area",
                fontFamily: "Roboto, Arial, sans-serif",
                foreColor: "#5d6162",
                zoom: { enabled: !1 },
                sparkline: { enabled: !0 },
            },
            tooltip: {
                enabled: !0,
                x: { show: !1 },
                y: {
                    title: {
                        formatter: function (r) {
                            return "";
                        },
                    },
                },
                marker: { show: !1 },
            },
            dataLabels: { enabled: !1 },
            stroke: { curve: "straight" },
            title: { text: void 0 },
            grid: { borderColor: "transparent" },
            xaxis: { crosshairs: { show: !1 } },
            colors: ["#64af6d"],
            stroke: { width: [1] },
            fill: {
                type: "gradient",
                gradient: { opacityFrom: 0.5, opacityTo: 0.2, stops: [0, 60] },
            },
        },
        Dr = new ApexCharts(document.querySelector("#sleepTrack"), De);
    Dr.render();
}
(function () {
    var a = document.getElementById("btcCoin");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [{ data: [34, 55, 41, 67, 22, 43, 21] }],
                chart: {
                    sparkline: { enabled: !0 },
                    dropShadow: {
                        enabled: !0,
                        enabledOnSeries: void 0,
                        top: 3,
                        right: 6,
                        blur: 3,
                        color: ["#47bbed"],
                        opacity: 0.2,
                    },
                    type: "line",
                    height: 20,
                    width: 100,
                },
                tooltip: {
                    x: { show: !1 },
                    y: {
                        title: {
                            formatter: function (h) {
                                return "";
                            },
                        },
                    },
                    marker: { show: !1 },
                },
                colors: ["#47bbed"],
                stroke: { width: [1.5], curve: ["smooth"] },
                xaxis: { crosshairs: { show: !1 } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.9,
                        opacityTo: 0.9,
                        stops: [0, 98],
                    },
                },
            },
            r = new ApexCharts(document.querySelector("#btcCoin"), t);
        r.render();
    }
    var a = document.getElementById("ethCoin");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [{ data: [34, 55, 41, 47, 32, 53, 31] }],
                chart: {
                    sparkline: { enabled: !0 },
                    dropShadow: {
                        enabled: !0,
                        enabledOnSeries: void 0,
                        top: 3,
                        right: 6,
                        blur: 3,
                        color: ["#60a5fa"],
                        opacity: 0.2,
                    },
                    type: "line",
                    height: 20,
                    width: 100,
                },
                tooltip: {
                    x: { show: !1 },
                    y: {
                        title: {
                            formatter: function (p) {
                                return "";
                            },
                        },
                    },
                    marker: { show: !1 },
                },
                colors: ["#60a5fa"],
                stroke: { width: [1.5], curve: ["smooth"] },
                xaxis: { crosshairs: { show: !1 } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.9,
                        opacityTo: 0.9,
                        stops: [0, 98],
                    },
                },
            },
            o = new ApexCharts(document.querySelector("#ethCoin"), t);
        o.render();
    }
    var a = document.getElementById("dshCoin");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [{ data: [31, 53, 32, 47, 41, 55, 44] }],
                chart: {
                    sparkline: { enabled: !0 },
                    dropShadow: {
                        enabled: !0,
                        enabledOnSeries: void 0,
                        top: 3,
                        right: 6,
                        blur: 3,
                        color: ["#FF534D"],
                        opacity: 0.2,
                    },
                    type: "line",
                    height: 20,
                    width: 100,
                },
                tooltip: {
                    x: { show: !1 },
                    y: {
                        title: {
                            formatter: function (q) {
                                return "";
                            },
                        },
                    },
                    marker: { show: !1 },
                },
                colors: ["#FF534D"],
                stroke: { width: [1.5], curve: ["smooth"] },
                xaxis: { crosshairs: { show: !1 } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.9,
                        opacityTo: 0.9,
                        stops: [0, 98],
                    },
                },
            },
            o = new ApexCharts(document.querySelector("#dshCoin"), t);
        o.render();
    }
    var a = document.getElementById("glmCoin");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [{ data: [21, 43, 22, 45, 35, 55, 34] }],
                chart: {
                    sparkline: { enabled: !0 },
                    dropShadow: {
                        enabled: !0,
                        enabledOnSeries: void 0,
                        top: 3,
                        right: 6,
                        blur: 3,
                        color: ["#FFBE14"],
                        opacity: 0.2,
                    },
                    type: "line",
                    height: 20,
                    width: 100,
                },
                tooltip: {
                    x: { show: !1 },
                    y: {
                        title: {
                            formatter: function (q) {
                                return "";
                            },
                        },
                    },
                    marker: { show: !1 },
                },
                colors: ["#FFBE14"],
                stroke: { width: [1.5], curve: ["smooth"] },
                xaxis: { crosshairs: { show: !1 } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.9,
                        opacityTo: 0.9,
                        stops: [0, 98],
                    },
                },
            },
            o = new ApexCharts(document.querySelector("#glmCoin"), t);
        o.render();
    }
    var a = document.getElementById("totalRevenue");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [
                    {
                        name: "Revenue",
                        data: [55, 55, 52, 52, 55, 55, 58, 58, 53, 53, 55, 55],
                    },
                ],
                chart: {
                    height: 180,
                    type: "area",
                    sparkline: { enabled: !0 },
                },
                dataLabels: { enabled: !1 },
                stroke: { width: [1.4], show: !0, curve: ["smooth"] },
                xaxis: { crosshairs: { show: !1 } },
                legend: { show: !1 },
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                markers: { size: 0 },
                colors: ["#60a5fa"],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.7,
                        stops: [0, 100],
                    },
                },
            },
            o = new ApexCharts(document.querySelector("#totalRevenue"), t);
        o.render();
    }
    var a = document.getElementById("sessionsByDevice");
    if (a !== null) {
        a.innerHTML = "";
        var t = {
                series: [
                    { name: "Tablet", data: [[10, 35, 80]] },
                    { name: "Mobile", data: [[22, 10, 80]] },
                    { name: "Desktop", data: [[25, 25, 150]] },
                ],
                chart: { height: 350, type: "bubble", toolbar: { show: !1 } },
                grid: { borderColor: "#f3f3f3", strokeDashArray: 3 },
                colors: ["#f43f63", "#60a5fa", "#6366f1"],
                dataLabels: { enabled: !1 },
                legend: {
                    show: !0,
                    fontSize: "13px",
                    labels: { colors: "#959595" },
                    markers: { width: 10, height: 10 },
                },
                xaxis: {
                    min: 0,
                    max: 50,
                    labels: { show: !1 },
                    axisBorder: { show: !1 },
                },
                yaxis: { max: 50, labels: { show: !1 } },
            },
            l = new ApexCharts(document.querySelector("#sessionsByDevice"), t);
        l.render();
    }
    if (typeof jsVectorMap < "u") {
        var s = [
                {
                    name: "Russia",
                    coords: [61, 105],
                    style: { fill: "#60a5fa" },
                },
                {
                    name: "Geenland",
                    coords: [72, -42],
                    style: { fill: "#6366f1" },
                },
                {
                    name: "Canada",
                    coords: [56, -106],
                    style: { fill: "#ff534d" },
                },
                {
                    name: "Palestine",
                    coords: [31.5, 34.8],
                    style: { fill: "#ffbe14" },
                },
                {
                    name: "Brazil",
                    coords: [-14.235, -51.9253],
                    style: { fill: "#f43f63" },
                },
            ],
            a = document.getElementById("users-map");
        a !== null &&
            ((a.innerHTML = ""),
            new jsVectorMap({
                map: "world_merc",
                selector: "#users-map",
                markersSelectable: !0,
                onMarkerSelected(p, q, v) {},
                labels: {
                    markers: {
                        render: function (p) {
                            return p.name;
                        },
                    },
                },
                markers: s,
                markerStyle: {
                    hover: { stroke: "#DDD", strokeWidth: 3, fill: "#FFF" },
                    selected: { fill: "#ff525d" },
                },
                markerLabelStyle: {
                    initial: {
                        fontFamily: "Poppins",
                        fontSize: 13,
                        fontWeight: 500,
                        fill: "#35373e",
                    },
                },
            }));
    }
})();
function Tr(t) {
    var r = {
        series: [{ data: [17, 22, 37, 47, 39, 28, 14], name: "Revenue" }],
        chart: {
            type: "bar",
            height: 235,
            toolbar: { show: !1 },
            dropShadow: {
                enabled: !0,
                enabledOnSeries: void 0,
                top: 6,
                left: 6,
                blur: 3,
                color: "#000",
                opacity: 0.05,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "35%",
                borderRadius: 4,
                horizontal: !1,
                colors: {
                    ranges: [
                        { from: 41, to: 1 / 0, color: "rgb(" + t + ")" },
                        { from: 0, to: 40, color: "rgba(" + t + ", 0.2)" },
                    ],
                },
            },
        },
        dataLabels: { enabled: !1 },
        grid: {
            show: !1,
            borderColor: "transparent",
            padding: { top: 0, right: 0, bottom: 0, left: 0 },
            yaxis: { lines: { show: !1 } },
        },
        xaxis: {
            categories: ["Mon", "Tues", "Wed", "Thu", "Fri", "Sat", "Sun"],
            colors: "#fff",
            axisBorder: { show: !1 },
            axisTicks: { show: !1 },
            labels: { rotate: -90, style: { fontFamily: "Inter, sans-serif" } },
        },
        yaxis: {
            colors: "#fff",
            axisBorder: { show: !1 },
            axisTicks: { show: !1 },
            labels: { show: !1 },
        },
    };
    document.querySelector("#report").innerHTML = "";
    var o = new ApexCharts(document.querySelector("#report"), r);
    o.render();
}
function Rr(t) {
    var r = {
        series: [
            {
                name: "Job Applied",
                type: "line",
                data: [25, 50, 30, 55, 20, 45, 30],
            },
            {
                name: "Job Viewed",
                type: "area",
                data: [35, 25, 40, 30, 45, 35, 60],
            },
        ],
        chart: {
            height: 350,
            type: "line",
            stacked: !1,
            toolbar: { show: !1 },
            dropShadow: {
                enabled: !0,
                enabledOnSeries: void 0,
                top: 7,
                left: 1,
                blur: 3,
                color: "#000",
                opacity: 0.2,
            },
        },
        colors: ["rgba(" + t + ", 1)", "rgba(" + t + ", 0.1)"],
        grid: {
            borderColor: "#e9edf4",
            padding: { top: 10, right: 0, bottom: 0, left: 0 },
        },
        stroke: { width: [2, 2], curve: "smooth", dashArray: [0, 4] },
        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        markers: { size: 4, hover: { size: 5 } },
        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: !1,
                shadeIntensity: 1,
                shade: "light",
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100],
            },
        },
        legend: {
            show: !0,
            position: "top",
            fontFamily: "Inter, sans-serif",
            markers: { width: 10, height: 10 },
        },
        xaxis: {
            type: "week",
            axisBorder: {
                show: !0,
                color: "rgba(119, 119, 142, 0.05)",
                offsetX: 0,
                offsetY: 0,
            },
            axisTicks: {
                show: !0,
                borderType: "solid",
                color: "rgba(119, 119, 142, 0.05)",
                width: 6,
                offsetX: 0,
                offsetY: 0,
            },
            labels: { rotate: -90 },
        },
        yaxis: {
            title: {
                style: {
                    color: "#adb5be",
                    fontSize: "14px",
                    fontFamily: "Inter, sans-serif",
                    fontWeight: 600,
                },
            },
            labels: {
                formatter: function (a) {
                    return a.toFixed(0) + "";
                },
            },
        },
        tooltip: {
            shared: !0,
            intersect: !1,
            y: {
                formatter: function (a) {
                    return typeof a < "u" ? a.toFixed(0) + " points" : a;
                },
            },
        },
    };
    document.querySelector("#views").innerHTML = "";
    var o = new ApexCharts(document.querySelector("#views"), r);
    o.render();
}
const Te = 300,
    b = document.getElementById("sidebar");
let K = document.querySelector(".main-content");
const Pr = document.querySelectorAll(".nav > ul > .slide.has-sub"),
    Or = document.querySelectorAll(".nav > ul > .slide.has-sub > a"),
    Hr = document.querySelectorAll(
        ".nav > ul > .slide.has-sub .slide.has-sub > a"
    );
class Fr {
    constructor(r, o) {
        J(this, "instance", null);
        J(this, "reference", null);
        J(this, "popperTarget", null);
        this.init(r, o);
    }
    init(r, o) {
        (this.reference = r),
            (this.popperTarget = o),
            (this.instance = Popper.createPopper(
                this.reference,
                this.popperTarget,
                {
                    placement: "bottom",
                    strategy: "relative",
                    resize: !0,
                    modifiers: [
                        { name: "computeStyles", options: { adaptive: !1 } },
                    ],
                }
            )),
            document.addEventListener(
                "click",
                (l) => this.clicker(l, this.popperTarget, this.reference),
                !1
            );
        const a = new ResizeObserver(() => {
            this.instance.update();
        });
        a.observe(this.popperTarget), a.observe(this.reference);
    }
    clicker(r, o, a) {
        b.classList.contains("collapsed") &&
            !o.contains(r.target) &&
            !a.contains(r.target) &&
            this.hide();
    }
    hide() {}
}
class $r {
    constructor() {
        J(this, "subMenuPoppers", []);
        this.init();
    }
    init() {
        Pr.forEach((r) => {
            this.subMenuPoppers.push(new Fr(r, r.lastElementChild)),
                this.closePoppers();
        });
    }
    togglePopper(r) {
        window.getComputedStyle(r).visibility === "hidden" &&
        window.getComputedStyle(r).visibility === void 0
            ? (r.style.visibility = "visible")
            : (r.style.visibility = "hidden");
    }
    updatePoppers() {
        this.subMenuPoppers.forEach((r) => {
            (r.instance.state.elements.popper.style.display = "none"),
                r.instance.update();
        });
    }
    closePoppers() {
        this.subMenuPoppers.forEach((r) => {
            r.hide();
        });
    }
}
const ae = (t, r = Te) => {
        const { parentElement: o } = t;
        o.classList.remove("open"),
            (t.style.transitionProperty = "height, margin, padding"),
            (t.style.transitionDuration = `${r}ms`),
            (t.style.boxSizing = "border-box"),
            (t.style.height = `${t.offsetHeight}px`),
            t.offsetHeight,
            (t.style.overflow = "hidden"),
            (t.style.height = 0),
            (t.style.paddingTop = 0),
            (t.style.paddingBottom = 0),
            (t.style.marginTop = 0),
            (t.style.marginBottom = 0),
            window.setTimeout(() => {
                (t.style.display = "none"),
                    t.style.removeProperty("height"),
                    t.style.removeProperty("padding-top"),
                    t.style.removeProperty("padding-bottom"),
                    t.style.removeProperty("margin-top"),
                    t.style.removeProperty("margin-bottom"),
                    t.style.removeProperty("overflow"),
                    t.style.removeProperty("transition-duration"),
                    t.style.removeProperty("transition-property");
            }, r);
    },
    Wt = (t, r = Te) => {
        const { parentElement: o } = t;
        o.classList.add("open"), t.style.removeProperty("display");
        let { display: a } = window.getComputedStyle(t);
        a === "none" && (a = "block"), (t.style.display = a);
        const l = t.offsetHeight;
        (t.style.overflow = "hidden"),
            (t.style.height = 0),
            (t.style.paddingTop = 0),
            (t.style.paddingBottom = 0),
            (t.style.marginTop = 0),
            (t.style.marginBottom = 0),
            t.offsetHeight,
            (t.style.boxSizing = "border-box"),
            (t.style.transitionProperty = "height, margin, padding"),
            (t.style.transitionDuration = `${r}ms`),
            (t.style.height = `${l}px`),
            t.style.removeProperty("padding-top"),
            t.style.removeProperty("padding-bottom"),
            t.style.removeProperty("margin-top"),
            t.style.removeProperty("margin-bottom"),
            window.setTimeout(() => {
                t.style.removeProperty("height"),
                    t.style.removeProperty("overflow"),
                    t.style.removeProperty("transition-duration"),
                    t.style.removeProperty("transition-property");
            }, r);
    },
    Gt = (t, r = Te) => {
        let o = document.querySelector("html");
        if (
            !(
                (o.getAttribute("data-nav-style") === "menu-hover" &&
                    o.getAttribute("data-toggled") === "menu-hover-closed" &&
                    window.innerWidth >= 992) ||
                (o.getAttribute("data-nav-style") === "icon-hover" &&
                    o.getAttribute("data-toggled") === "icon-hover-closed" &&
                    window.innerWidth >= 992)
            ) &&
            t &&
            t.nodeType != 3
        )
            return window.getComputedStyle(t).display === "none"
                ? Wt(t, r)
                : ae(t, r);
    };
new $r();
const zr = document.querySelectorAll(".slide.has-sub.open");
zr.forEach((t) => {
    t.lastElementChild.style.display = "block";
});
Or.forEach((t) => {
    t.addEventListener("click", () => {
        let r = document.querySelector("html");
        if (
            (r.getAttribute("data-nav-style") != "menu-hover" &&
                r.getAttribute("data-nav-style") != "icon-hover") ||
            window.innerWidth < 992 ||
            (!r.getAttribute("data-toggled") &&
                r.getAttribute("data-nav-layout") != "horizontal")
        ) {
            const o = t.closest(".nav.sub-open");
            o &&
                o
                    .querySelectorAll(":scope > ul > .slide.has-sub > a")
                    .forEach((a) => {
                        (a.nextElementSibling.style.display === "block" ||
                            window.getComputedStyle(a.nextElementSibling)
                                .display === "block") &&
                            ae(a.nextElementSibling);
                    }),
                Gt(t.nextElementSibling);
        }
    });
});
Hr.forEach((t) => {
    let r = document.querySelector("html");
    t.addEventListener("click", () => {
        if (
            (r.getAttribute("data-nav-style") != "menu-hover" &&
                r.getAttribute("data-nav-style") != "icon-hover") ||
            window.innerWidth < 992 ||
            (!r.getAttribute("data-toggled") &&
                r.getAttribute("data-nav-layout") != "horizontal")
        ) {
            const o = t.closest(".slide-menu");
            o &&
                o.querySelectorAll(":scope .slide.has-sub > a").forEach((a) => {
                    var l;
                    a.nextElementSibling &&
                        ((l = a.nextElementSibling) == null
                            ? void 0
                            : l.style.display) === "block" &&
                        ae(a.nextElementSibling);
                }),
                Gt(t.nextElementSibling);
        }
    });
});
window.addEventListener("resize", () => {
    let t = document.querySelector(".main-content");
    setTimeout(() => {
        window.innerWidth <= 992
            ? t.addEventListener("click", $)
            : t.removeEventListener("click", $);
    }, 100);
});
let wt, A;
(() => {
    let t = document.querySelector("html");
    (wt = document.querySelector(".sidemenu-toggle")),
        wt.addEventListener("click", L);
    let r = document.querySelector(".main-content");
    window.innerWidth <= 992
        ? r.addEventListener("click", $)
        : r.removeEventListener("click", $),
        (A = [window.innerWidth]),
        R(),
        t.getAttribute("data-nav-layout") === "horizontal" &&
        window.innerWidth >= 992
            ? (w(), r.addEventListener("click", w))
            : r.removeEventListener("click", w),
        window.addEventListener("resize", W),
        Pe(),
        !localStorage.getItem("Ynexlayout") &&
            !localStorage.getItem("Ynexnavstyles") &&
            !localStorage.getItem("Ynexverticalstyles") &&
            !document.querySelector(".landing-body") &&
            document.querySelector("html").getAttribute("data-nav-layout") !==
                "horizontal" &&
            !t.getAttribute("data-vertical-style") &&
            !t.getAttribute("data-nav-style") &&
            Re(),
        L(),
        (t.getAttribute("data-nav-style") === "menu-hover" ||
            t.getAttribute("data-nav-style") === "icon-hover") &&
            window.innerWidth >= 992 &&
            w(),
        window.innerWidth < 992 && t.setAttribute("data-toggled", "close");
})();
function W() {
    let t = document.querySelector("html"),
        r = document.querySelector(".main-content");
    A.push(window.innerWidth),
        A.length > 2 && A.shift(),
        A.length > 1 &&
            (A[A.length - 1] < 992 &&
                A[A.length - 2] >= 992 &&
                (r.addEventListener("click", $),
                R(),
                L(),
                r.removeEventListener("click", w)),
            A[A.length - 1] >= 992 &&
                A[A.length - 2] < 992 &&
                (r.removeEventListener("click", $),
                L(),
                t.getAttribute("data-nav-layout") === "horizontal"
                    ? (w(), r.addEventListener("click", w))
                    : r.removeEventListener("click", w),
                document.documentElement.getAttribute("data-vertical-style") ==
                "doublemenu"
                    ? document.querySelector(".double-menu-active")
                        ? t.setAttribute("data-toggled", "double-menu-open")
                        : t.setAttribute("data-toggled", "double-menu-close")
                    : t.removeAttribute("data-toggled"))),
        Oe(),
        A[A.length - 1] >= 992 &&
            localStorage.ynexnavstyles == "menu-click" &&
            t.removeAttribute("data-toggled");
}
function $() {
    document.querySelector("html").setAttribute("data-toggled", "close"),
        document
            .querySelector("#responsive-overlay")
            .classList.remove("active");
}
function L() {
    let t = document.querySelector("html"),
        r = t.getAttribute("data-nav-layout");
    if (window.innerWidth >= 992) {
        if (r === "vertical") {
            switch (
                (b.removeEventListener("mouseenter", O),
                b.removeEventListener("mouseleave", H),
                b.removeEventListener("click", Q),
                K.removeEventListener("click", Z),
                document
                    .querySelectorAll(".main-menu li > .side-menu__item")
                    .forEach((s) => s.removeEventListener("click", He)),
                t.getAttribute("data-vertical-style"))
            ) {
                case "closed":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "close-menu-close"
                            ? t.removeAttribute("data-toggled")
                            : t.setAttribute(
                                  "data-toggled",
                                  "close-menu-close"
                              );
                    break;
                case "overlay":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "icon-overlay-close"
                            ? (t.removeAttribute(
                                  "data-toggled",
                                  "icon-overlay-close"
                              ),
                              b.removeEventListener("mouseenter", O),
                              b.removeEventListener("mouseleave", H))
                            : window.innerWidth >= 992
                            ? (t.setAttribute(
                                  "data-toggled",
                                  "icon-overlay-close"
                              ),
                              b.addEventListener("mouseenter", O),
                              b.addEventListener("mouseleave", H))
                            : (b.removeEventListener("mouseenter", O),
                              b.removeEventListener("mouseleave", H));
                    break;
                case "icontext":
                    t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "icon-text-close"
                            ? (t.removeAttribute(
                                  "data-toggled",
                                  "icon-text-close"
                              ),
                              b.removeEventListener("click", Q),
                              K.removeEventListener("click", Z))
                            : (t.setAttribute(
                                  "data-toggled",
                                  "icon-text-close"
                              ),
                              window.innerWidth >= 992
                                  ? (b.addEventListener("click", Q),
                                    K.addEventListener("click", Z))
                                  : (b.removeEventListener("click", Q),
                                    K.removeEventListener("click", Z)));
                    break;
                case "doublemenu":
                    if (
                        (t.removeAttribute("data-nav-style"),
                        t.getAttribute("data-toggled") === "double-menu-open")
                    )
                        t.setAttribute("data-toggled", "double-menu-close"),
                            document.querySelector(".slide-menu") &&
                                document
                                    .querySelectorAll(".slide-menu")
                                    .forEach((h) => {
                                        h.classList.contains(
                                            "double-menu-active"
                                        ) &&
                                            h.classList.remove(
                                                "double-menu-active"
                                            );
                                    });
                    else {
                        let s = document.querySelector(
                            ".side-menu__item.active"
                        );
                        s &&
                            (t.setAttribute("data-toggled", "double-menu-open"),
                            s.nextElementSibling
                                ? s.nextElementSibling.classList.add(
                                      "double-menu-active"
                                  )
                                : document
                                      .querySelector("html")
                                      .setAttribute("data-toggled", ""));
                    }
                    Zr();
                    break;
                case "detached":
                    t.getAttribute("data-toggled") === "detached-close"
                        ? (t.removeAttribute("data-toggled", "detached-close"),
                          b.removeEventListener("mouseenter", O),
                          b.removeEventListener("mouseleave", H))
                        : (t.setAttribute("data-toggled", "detached-close"),
                          window.innerWidth >= 992
                              ? (b.addEventListener("mouseenter", O),
                                b.addEventListener("mouseleave", H))
                              : (b.removeEventListener("mouseenter", O),
                                b.removeEventListener("mouseleave", H)));
                    break;
                case "default":
                    Re(), t.removeAttribute("data-toggled");
            }
            switch (t.getAttribute("data-nav-style")) {
                case "menu-click":
                    t.getAttribute("data-toggled") === "menu-click-closed"
                        ? t.removeAttribute("data-toggled")
                        : t.setAttribute("data-toggled", "menu-click-closed");
                    break;
                case "menu-hover":
                    t.getAttribute("data-toggled") === "menu-hover-closed"
                        ? (t.removeAttribute("data-toggled"), R())
                        : (t.setAttribute("data-toggled", "menu-hover-closed"),
                          w());
                    break;
                case "icon-click":
                    t.getAttribute("data-toggled") === "icon-click-closed"
                        ? t.removeAttribute("data-toggled")
                        : t.setAttribute("data-toggled", "icon-click-closed");
                    break;
                case "icon-hover":
                    t.getAttribute("data-toggled") === "icon-hover-closed"
                        ? (t.removeAttribute("data-toggled"), R())
                        : (t.setAttribute("data-toggled", "icon-hover-closed"),
                          w());
                    break;
            }
        }
    } else if (t.getAttribute("data-toggled") === "close") {
        t.setAttribute("data-toggled", "open");
        let o = document.createElement("div");
        (o.id = "responsive-overlay"),
            setTimeout(() => {
                document.querySelector("html").getAttribute("data-toggled") ==
                    "open" &&
                    (document
                        .querySelector("#responsive-overlay")
                        .classList.add("active"),
                    document
                        .querySelector("#responsive-overlay")
                        .addEventListener("click", () => {
                            document
                                .querySelector("#responsive-overlay")
                                .classList.remove("active"),
                                $();
                        })),
                    window.addEventListener("resize", () => {
                        window.screen.width >= 992 &&
                            document
                                .querySelector("#responsive-overlay")
                                .classList.remove("active");
                    });
            }, 100);
    } else t.setAttribute("data-toggled", "close");
}
function O() {
    document.querySelector("html").setAttribute("data-icon-overlay", "open");
}
function H() {
    document.querySelector("html").removeAttribute("data-icon-overlay");
}
function Q() {
    document.querySelector("html").setAttribute("data-icon-text", "open");
}
function Z() {
    document.querySelector("html").removeAttribute("data-icon-text");
}
function Wr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "closed"),
        t.removeAttribute("data-nav-style", ""),
        L();
}
function Gr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "detached"),
        t.setAttribute("data-header-position", "fixed"),
        t.removeAttribute("data-nav-style", ""),
        L();
}
function Jr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "icontext"),
        t.removeAttribute("data-nav-style", ""),
        L();
}
function Re() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "overlay"),
        t.removeAttribute("data-nav-style", ""),
        L();
}
function Nr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "doublemenu"),
        t.removeAttribute("data-nav-style", ""),
        L(),
        document.querySelectorAll(".main-menu > li > .side-menu__item");
    const r = document.createElement("div");
    r.style.setProperty("position", "fixed"),
        r.style.setProperty("display", "none"),
        r.style.setProperty("padding", "0.5rem"),
        r.style.setProperty("font-weight", "500"),
        r.style.setProperty("font-size", "0.75rem"),
        r.style.setProperty("background-color", "rgb(15, 23 ,42)"),
        r.style.setProperty("color", "rgb(255, 255 ,255)"),
        r.style.setProperty("margin-inline-start", "45px"),
        r.style.setProperty("border-radius", "0.25rem"),
        r.style.setProperty("z-index", "99");
}
function Yr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "menu-click"),
        t.removeAttribute("data-hor-style"),
        t.removeAttribute("data-vertical-style"),
        L(),
        t.getAttribute("data-nav-layout") === "vertical" && R();
}
function _r() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "menu-hover"),
        t.removeAttribute("data-hor-style"),
        t.removeAttribute("data-vertical-style"),
        document.querySelectorAll(".slide.has-sub").forEach((o) => {
            o.addEventListener("mouseenter", Qr),
                o.addEventListener("mouseleave", Kr);
        }),
        L(),
        t.getAttribute("data-toggled") === "menu-hover-closed" && w();
}
function Xr() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-style", "icon-click"),
        L(),
        t.getAttribute("data-nav-layout") === "vertical" && R();
}
function jr() {
    document.querySelector("html").setAttribute("data-nav-style", "icon-hover"),
        L(),
        w();
}
function R() {
    let t = window.location.pathname.split("/")[0];
    (t = location.pathname == "/" ? "index" : location.pathname.substring(1)),
        (t = t.substring(t.lastIndexOf("/") + 1)),
        document.querySelectorAll(".side-menu__item").forEach((o) => {
            if (
                (t === "/" && (t = "index"),
                o.getAttribute("href") === window.location.href)
            ) {
                o.classList.add("active"),
                    o.parentElement.classList.add("active");
                let a = o.closest("ul"),
                    l = o.closest("ul:not(.main-menu)"),
                    s = !0;
                for (; s; )
                    a
                        ? (a.classList.add("active"),
                          a.previousElementSibling.classList.add("active"),
                          a.parentElement.classList.add("active"),
                          Wt(a),
                          (a = a.parentElement.closest("ul")),
                          a &&
                              a.closest("ul:not(.main-menu)") &&
                              (l = a.closest("ul:not(.main-menu)")),
                          l || (s = !1))
                        : (s = !1);
            }
        });
}
function w() {
    document.querySelectorAll("ul.slide-menu").forEach((r) => {
        let o = r.closest("ul"),
            a = r.closest("ul:not(.main-menu)");
        if (o) {
            let l = o.closest("ul.main-menu");
            for (; l; )
                o.classList.add("active"),
                    ae(o),
                    (o = o.parentElement.closest("ul")),
                    (a = o.closest("ul:not(.main-menu)")),
                    a || (l = !1);
        }
    });
}
function Pe() {
    function t() {
        let r = document.querySelectorAll(".slide"),
            o = document.querySelectorAll(".slide-menu");
        r.forEach((a, l) => {
            a.classList.contains("is-expanded") == !0 &&
                a.classList.remove("is-expanded");
        }),
            o.forEach((a, l) => {
                a.classList.contains("open") == !0 &&
                    (a.classList.remove("open"), (a.style.display = "none"));
            });
    }
    t();
}
let F = document.querySelector(".slide-left"),
    M = document.querySelector(".slide-right");
F.addEventListener("click", () => {
    let t = document.querySelector(".main-menu"),
        r = document.querySelector(".main-sidebar"),
        o = Math.ceil(
            Number(window.getComputedStyle(t).marginLeft.split("px")[0])
        ),
        a = Math.ceil(
            Number(window.getComputedStyle(t).marginRight.split("px")[0])
        ),
        l = r.offsetWidth;
    t.scrollWidth > r.offsetWidth
        ? document.querySelector("html").getAttribute("dir") !== "rtl"
            ? o < 0 && !(Math.abs(o) < l)
                ? ((t.style.marginRight = 0),
                  (t.style.marginLeft =
                      Number(t.style.marginLeft.split("px")[0]) +
                      Math.abs(l) +
                      "px"),
                  M.classList.remove("hidden"))
                : (o >= 0,
                  (t.style.marginLeft = "0px"),
                  F.classList.add("hidden"),
                  M.classList.remove("hidden"))
            : a < 0 && !(Math.abs(a) < l)
            ? ((t.style.marginLeft = 0),
              (t.style.marginRight =
                  Number(t.style.marginRight.split("px")[0]) +
                  Math.abs(l) +
                  "px"),
              M.classList.remove("hidden"))
            : (a >= 0,
              (t.style.marginRight = "0px"),
              F.classList.add("hidden"),
              M.classList.remove("hidden"))
        : ((document.querySelector(".main-menu").style.marginLeft = "0px"),
          (document.querySelector(".main-menu").style.marginRight = "0px"));
    let s = document.querySelector(".main-menu > .slide.open"),
        h = document.querySelector(".main-menu > .slide.open >ul");
    s && s.classList.remove("active"), h && (h.style.display = "none"), Pe();
});
M.addEventListener("click", () => {
    let t = document.querySelector(".main-menu"),
        r = document.querySelector(".main-sidebar"),
        o = Math.ceil(
            Number(window.getComputedStyle(t).marginLeft.split("px")[0])
        ),
        a = Math.ceil(
            Number(window.getComputedStyle(t).marginRight.split("px")[0])
        ),
        l = t.scrollWidth - r.offsetWidth,
        s = r.offsetWidth;
    t.scrollWidth > r.offsetWidth &&
        (document.querySelector("html").getAttribute("dir") !== "rtl"
            ? Math.abs(l) > Math.abs(o) &&
              ((t.style.marginRight = 0),
              Math.abs(l) > Math.abs(o) + s ||
                  ((s = Math.abs(l) - Math.abs(o)), M.classList.add("hidden")),
              (t.style.marginLeft =
                  Number(t.style.marginLeft.split("px")[0]) -
                  Math.abs(s) +
                  "px"),
              F.classList.remove("hidden"))
            : Math.abs(l) > Math.abs(a) &&
              ((t.style.marginLeft = 0),
              Math.abs(l) > Math.abs(a) + s ||
                  ((s = Math.abs(l) - Math.abs(a)), M.classList.add("hidden")),
              (t.style.marginRight =
                  Number(t.style.marginRight.split("px")[0]) -
                  Math.abs(s) +
                  "px"),
              F.classList.remove("hidden")));
    let h = document.querySelector(".main-menu > .slide.open"),
        p = document.querySelector(".main-menu > .slide.open >ul");
    h && h.classList.remove("active"), p && (p.style.display = "none"), Pe();
});
function Oe() {
    var p;
    let t = document.querySelector(".main-menu"),
        r = document.querySelector(".main-sidebar"),
        o = document.querySelector(".slide-left"),
        a = document.querySelector(".slide-right"),
        l = Math.ceil(
            Number(window.getComputedStyle(t).marginLeft.split("px")[0])
        ),
        s = Math.ceil(
            Number(window.getComputedStyle(t).marginRight.split("px")[0])
        ),
        h = t.scrollWidth - r.offsetWidth;
    if (
        (t.scrollWidth > r.offsetWidth
            ? (a.classList.remove("hidden"), o.classList.add("hidden"))
            : (a.classList.add("hidden"),
              o.classList.add("hidden"),
              (t.style.marginLeft = "0px"),
              (t.style.marginRight = "0px")),
        document.querySelector("html").getAttribute("data-nav-layout") ===
            "horizontal" && window.innerWidth > 992)
    ) {
        document.querySelectorAll(".slide.has-sub.open > ul").forEach((d) => {
            let f = d,
                B = document.documentElement;
            const E = f.closest("li");
            var i = E.getBoundingClientRect(),
                k = f.getBoundingClientRect().width,
                G = i.right + k,
                z = i.left - k;
            B.getAttribute("dir") == "rtl"
                ? (d.classList.contains("child1") && i.left < 0 && w(),
                  z < 0 ||
                  (E.closest("ul").classList.contains("force-left") &&
                      G < window.innerWidth)
                      ? f.classList.add("force-left")
                      : f.classList.remove("force-left"))
                : (d.classList.contains("child1") &&
                      i.right > window.innerWidth &&
                      w(),
                  G > window.innerWidth ||
                  (E.closest("ul").classList.contains("force-left") && z > 0)
                      ? f.classList.add("force-left")
                      : (z < 0, f.classList.remove("force-left")));
        });
        let v = document.querySelector(".slide-menu.active.force-left");
        v &&
            (document.querySelector("html").getAttribute("dir") != "rtl"
                ? v.getBoundingClientRect().right < innerWidth
                    ? v.classList.remove("force-left")
                    : v.getBoundingClientRect().left < 0 &&
                      (document.documentElement.getAttribute(
                          "data-nav-style"
                      ) == "menu-hover" ||
                          document.documentElement.getAttribute(
                              "data-nav-style"
                          ) == "icon-hover" ||
                          window.innerWidth > 992) &&
                      e.classList.remove("force-left")
                : v.getBoundingClientRect().left -
                      ((p = v.parentElement.closest(".slide-menu")) == null
                          ? void 0
                          : p.clientWidth) -
                      v.getBoundingClientRect().width >
                      0 &&
                  (document.documentElement.getAttribute("data-nav-style") ==
                      "menu-hover" ||
                      document.documentElement.getAttribute("data-nav-style") ==
                          "icon-hover" ||
                      window.innerWidth > 992) &&
                  v.classList.remove("force-left")),
            document.querySelectorAll(".main-menu .has-sub ul").forEach((d) => {
                if (Ur(d)) {
                    let f = d.getBoundingClientRect();
                    document.documentElement.getAttribute("dir") == "rtl"
                        ? f.left < 0 &&
                          (d.classList.contains("child1")
                              ? d.classList.remove("force-left")
                              : d.classList.add("force-left"))
                        : f.right > innerWidth &&
                          (d.classList.contains("child1")
                              ? d.classList.remove("force-left")
                              : d.classList.add("force-left"));
                }
            });
    }
    document.querySelector("html").getAttribute("dir") !== "rtl"
        ? (t.scrollWidth > r.offsetWidth &&
              Math.abs(h) < Math.abs(l) &&
              ((t.style.marginLeft = -h + "px"),
              o.classList.remove("hidden"),
              a.classList.add("hidden")),
          l == 0 ? o.classList.add("hidden") : o.classList.remove("hidden"))
        : (t.scrollWidth > r.offsetWidth &&
              Math.abs(h) < Math.abs(s) &&
              ((t.style.marginRight = -h + "px"),
              o.classList.remove("hidden"),
              a.classList.add("hidden")),
          s == 0 ? o.classList.add("hidden") : o.classList.remove("hidden")),
        (l != 0 || s != 0) && o.classList.remove("hidden");
}
function Ur(t) {
    return window.getComputedStyle(t).display != "none";
}
function Kr(t) {
    t.currentTarget.querySelector("ul").classList.remove("force-left");
}
function Qr(t) {
    let r = document.documentElement,
        o = t.currentTarget,
        a = o.querySelector("ul");
    if (
        o &&
        r.getAttribute("data-nav-layout") == "horizontal" &&
        (r.getAttribute("data-nav-style") == "menu-hover" ||
            r.getAttribute("data-nav-style") == "icon-hover")
    ) {
        const q = o.closest("li");
        var l = q.getBoundingClientRect(),
            s = a.getBoundingClientRect().width,
            h = l.right + s,
            p = l.left - s;
        r.getAttribute("dir") == "rtl"
            ? p < 0 ||
              (q.closest("ul").classList.contains("force-left") &&
                  h < window.innerWidth)
                ? a.classList.add("force-left")
                : a.classList.remove("force-left")
            : h > window.innerWidth ||
              (q.closest("ul").classList.contains("force-left") && p > 0)
            ? a.classList.add("force-left")
            : (p < 0, a.classList.remove("force-left"));
    }
}
["switcher-icon-click", "switcher-icon-hover", "switcher-horizontal"].map(
    (t) => {
        document.getElementById(t) &&
            document.getElementById(t).addEventListener("click", () => {
                let r = document.querySelector(".main-menu"),
                    o = document.querySelector(".main-sidebar");
                setTimeout(() => {
                    r.offsetWidth > o.offsetWidth
                        ? document
                              .getElementById("slide-right")
                              .classList.remove("hidden")
                        : document
                              .getElementById("slide-right")
                              .classList.add("hidden");
                }, 100);
            });
    }
);
function Zr() {
    window.innerWidth >= 992 &&
        (document.querySelector("html"),
        document
            .querySelectorAll(".main-menu > li > .side-menu__item")
            .forEach((r) => {
                r.addEventListener("click", He);
            }));
}
function He() {
    var t = this;
    let r = document.querySelector("html");
    var o = t.nextElementSibling;
    o &&
        (o.classList.contains("double-menu-active") ||
            (document.querySelector(".slide-menu") &&
                document.querySelectorAll(".slide-menu").forEach((l) => {
                    l.classList.contains("double-menu-active") &&
                        (l.classList.remove("double-menu-active"),
                        r.setAttribute("data-toggled", "double-menu-close"));
                }),
            o.classList.add("double-menu-active"),
            r.setAttribute("data-toggled", "double-menu-open")));
}
window.addEventListener("unload", () => {
    document.querySelector(".main-content").removeEventListener("click", w),
        window.removeEventListener("resize", W),
        document
            .querySelectorAll(".main-menu li > .side-menu__item")
            .forEach((o) => o.removeEventListener("click", He));
});
let Vr = () => {
    document.querySelectorAll(".side-menu__item").forEach((t) => {
        if (t.classList.contains("active")) {
            let r = t.getBoundingClientRect();
            t.children[0] &&
                t.parentElement.classList.contains("has-sub") &&
                r.top > 435 &&
                t.scrollIntoView({ behavior: "smooth" });
        }
    });
};
setTimeout(() => {
    Vr();
}, 300);
document.querySelector(".landing-body") ||
    document.querySelector(".content").addEventListener("click", () => {
        document.querySelectorAll(".slide-menu").forEach((t) => {
            (document.querySelector("html").getAttribute("data-toggled") ==
                "menu-click-closed" ||
                document.querySelector("html").getAttribute("data-toggled") ==
                    "icon-click-closed") &&
                (t.style.display = "none");
        });
    });
let Jt;
(function () {
    document.querySelector("html"),
        (Jt = document.querySelector(".main-content")),
        document.querySelector("#hs-overlay-switcher") &&
            (lo(),
            eo(),
            C(),
            setTimeout(() => {
                C();
            }, 1e3));
})();
function eo() {
    let t,
        r,
        o,
        a,
        l,
        s,
        h,
        p,
        q,
        v,
        P,
        d,
        f,
        B,
        E,
        i,
        k,
        G,
        z,
        Fe,
        $e,
        ze,
        We,
        Ge,
        Je,
        Ne,
        Ye,
        _e,
        Xe,
        je,
        Ue,
        Ke,
        Qe,
        Ze,
        Ve,
        et,
        tt,
        rt,
        ot,
        at,
        lt,
        nt,
        st,
        it,
        ct,
        dt,
        ut,
        mt,
        ht,
        yt,
        ft,
        gt,
        pt,
        n = document.querySelector("html");
    (l = document.querySelector("#switcher-light-theme")),
        (s = document.querySelector("#switcher-dark-theme")),
        (t = document.querySelector("#switcher-ltr")),
        (r = document.querySelector("#switcher-rtl")),
        (o = document.querySelector("#switcher-vertical")),
        (a = document.querySelector("#switcher-horizontal")),
        (h = document.querySelector("#switcher-boxed")),
        (p = document.querySelector("#switcher-full-width")),
        (d = document.querySelector("#switcher-menu-fixed")),
        (v = document.querySelector("#switcher-menu-scroll")),
        (P = document.querySelector("#switcher-header-fixed")),
        (q = document.querySelector("#switcher-header-scroll")),
        (f = document.querySelector("#switcher-header-light")),
        (B = document.querySelector("#switcher-header-dark")),
        (E = document.querySelector("#switcher-header-primary")),
        (i = document.querySelector("#switcher-header-gradient")),
        (ze = document.querySelector("#switcher-header-transparent")),
        (k = document.querySelector("#switcher-menu-light")),
        (G = document.querySelector("#switcher-menu-dark")),
        (z = document.querySelector("#switcher-menu-primary")),
        (Fe = document.querySelector("#switcher-menu-gradient")),
        ($e = document.querySelector("#switcher-menu-transparent")),
        (We = document.querySelector("#switcher-regular")),
        (Ge = document.querySelector("#switcher-classic")),
        (Je = document.querySelector("#switcher-modern")),
        (Ne = document.querySelector("#switcher-default-menu")),
        (Ke = document.querySelector("#switcher-menu-click")),
        (Qe = document.querySelector("#switcher-menu-hover")),
        (Ze = document.querySelector("#switcher-icon-click")),
        (Ve = document.querySelector("#switcher-icon-hover")),
        (Ye = document.querySelector("#switcher-closed-menu")),
        (_e = document.querySelector("#switcher-icontext-menu")),
        (je = document.querySelector("#switcher-icon-overlay")),
        (Ue = document.querySelector("#switcher-double-menu")),
        (Xe = document.querySelector("#switcher-detached")),
        document.querySelector("#resetbtn"),
        (et = document.querySelector("#switcher-primary")),
        (tt = document.querySelector("#switcher-primary1")),
        (rt = document.querySelector("#switcher-primary2")),
        (ot = document.querySelector("#switcher-primary3")),
        (at = document.querySelector("#switcher-primary4")),
        (lt = document.querySelector("#switcher-background")),
        (nt = document.querySelector("#switcher-background1")),
        (st = document.querySelector("#switcher-background2")),
        (it = document.querySelector("#switcher-background3")),
        (ct = document.querySelector("#switcher-background4")),
        (dt = document.querySelector("#switcher-bg-img")),
        (ut = document.querySelector("#switcher-bg-img1")),
        (mt = document.querySelector("#switcher-bg-img2")),
        (ht = document.querySelector("#switcher-bg-img3")),
        (yt = document.querySelector("#switcher-bg-img4")),
        (ft = document.querySelector("#reset-all")),
        (gt = document.querySelector("#switcher-loader-enable")),
        (pt = document.querySelector("#switcher-loader-disable")),
        et.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "58, 88, 146"),
                localStorage.setItem("primaryRGB1", "58 88 146"),
                n.style.setProperty("--primary-rgb", "58, 88, 146"),
                n.style.setProperty("--primary", "58 88 146"),
                I(),
                (document.querySelector("#switcher-primary").checked = !0);
        }),
        tt.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "92, 144, 163"),
                localStorage.setItem("primaryRGB1", "92 144 163"),
                n.style.setProperty("--primary-rgb", "92, 144, 163"),
                n.style.setProperty("--primary", "92 144 163"),
                I(),
                (document.querySelector("#switcher-primary1").checked = !0);
        }),
        rt.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "161, 90, 223"),
                localStorage.setItem("primaryRGB1", "161 90 223"),
                n.style.setProperty("--primary-rgb", "161, 90, 223"),
                n.style.setProperty("--primary", "161 90 223"),
                I(),
                (document.querySelector("#switcher-primary2").checked = !0);
        }),
        ot.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "78, 172, 76"),
                localStorage.setItem("primaryRGB1", "78 172 76"),
                n.style.setProperty("--primary-rgb", "78, 172, 76"),
                n.style.setProperty("--primary", "78 172 76"),
                I(),
                (document.querySelector("#switcher-primary3").checked = !0);
        }),
        at.addEventListener("click", () => {
            localStorage.setItem("primaryRGB", "223, 90, 90"),
                localStorage.setItem("primaryRGB1", "223 90 90"),
                n.style.setProperty("--primary-rgb", "223, 90, 90"),
                n.style.setProperty("--primary", "223 90 90"),
                I(),
                (document.querySelector("#switcher-primary4").checked = !0);
        }),
        lt.addEventListener("click", () => {
            localStorage.setItem(
                "bodyBgRGB",
                `${20 + 14} ${30 + 14} ${96 + 14}`
            ),
                localStorage.setItem("darkBgRGB", "20 30 96"),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.removeItem("hs_theme", "dark"),
                n.classList.add("dark"),
                n.classList.remove("light"),
                n.setAttribute("data-menu-styles", "dark"),
                n.setAttribute("data-header-styles", "dark"),
                document
                    .querySelector("html")
                    .style.setProperty("--light", "25 38 101"),
                document
                    .querySelector("html")
                    .style.setProperty("--input-border", "55 67 98"),
                localStorage.setItem("--light", "25 38 101"),
                document
                    .querySelector("html")
                    .style.setProperty("--body-bg", localStorage.bodyBgRGB),
                document
                    .querySelector("html")
                    .style.setProperty("--dark-bg", localStorage.darkBgRGB),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-background").checked = !0);
        }),
        nt.addEventListener("click", () => {
            localStorage.setItem(
                "bodyBgRGB",
                `${8 + 14} ${78 + 14} ${115 + 14}`
            ),
                localStorage.setItem("darkBgRGB", "8 78 115"),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.removeItem("hs_theme", "dark"),
                n.classList.add("dark"),
                n.classList.remove("light"),
                n.setAttribute("data-menu-styles", "dark"),
                n.setAttribute("data-header-styles", "dark"),
                document
                    .querySelector("html")
                    .style.setProperty("--light", "13 86 120"),
                document
                    .querySelector("html")
                    .style.setProperty("--input-border", "13 86 120"),
                localStorage.setItem("--light", "13 86 120"),
                document
                    .querySelector("html")
                    .style.setProperty("--body-bg", localStorage.bodyBgRGB),
                document
                    .querySelector("html")
                    .style.setProperty("--dark-bg", localStorage.darkBgRGB),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-background1").checked = !0);
        }),
        st.addEventListener("click", () => {
            localStorage.setItem(
                "bodyBgRGB",
                `${90 + 14} ${37 + 14} ${135 + 14}`
            ),
                localStorage.setItem("darkBgRGB", "90 37 135"),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.removeItem("hs_theme", "dark"),
                n.classList.add("dark"),
                n.classList.remove("light"),
                n.setAttribute("data-menu-styles", "dark"),
                n.setAttribute("data-header-styles", "dark"),
                document
                    .querySelector("html")
                    .style.setProperty("--light", "95 42 140"),
                document
                    .querySelector("html")
                    .style.setProperty("--input-border", "95 42 140"),
                localStorage.setItem("--light", "95 42 140"),
                document
                    .querySelector("html")
                    .style.setProperty("--body-bg", localStorage.bodyBgRGB),
                document
                    .querySelector("html")
                    .style.setProperty("--dark-bg", localStorage.darkBgRGB),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-background2").checked = !0);
        }),
        it.addEventListener("click", () => {
            localStorage.setItem(
                "bodyBgRGB",
                `${24 + 14} ${101 + 14} ${50 + 14}`
            ),
                localStorage.setItem("darkBgRGB", "24 101 51"),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.removeItem("hs_theme", "dark"),
                n.classList.add("dark"),
                n.classList.remove("light"),
                n.setAttribute("data-menu-styles", "dark"),
                n.setAttribute("data-header-styles", "dark"),
                document
                    .querySelector("html")
                    .style.setProperty("--light", "29 106 56"),
                document
                    .querySelector("html")
                    .style.setProperty("--input-border", "29 106 56"),
                localStorage.setItem("--light", "29 106 56"),
                document
                    .querySelector("html")
                    .style.setProperty("--body-bg", localStorage.bodyBgRGB),
                document
                    .querySelector("html")
                    .style.setProperty("--dark-bg", localStorage.darkBgRGB),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-background3").checked = !0);
        }),
        ct.addEventListener("click", () => {
            localStorage.setItem(
                "bodyBgRGB",
                `${120 + 14} ${66 + 14} ${20 + 14}`
            ),
                localStorage.setItem("darkBgRGB", "120 66 20"),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.removeItem("hs_theme", "dark"),
                n.classList.add("dark"),
                n.classList.remove("light"),
                n.setAttribute("data-menu-styles", "dark"),
                n.setAttribute("data-header-styles", "dark"),
                document
                    .querySelector("html")
                    .style.setProperty("--light", "125 71 25"),
                document
                    .querySelector("html")
                    .style.setProperty("--input-border", "125 71 25"),
                localStorage.setItem("--light", "125 71 25"),
                document
                    .querySelector("html")
                    .style.setProperty("--body-bg", localStorage.bodyBgRGB),
                document
                    .querySelector("html")
                    .style.setProperty("--dark-bg", localStorage.darkBgRGB),
                (document.querySelector("#switcher-dark-theme").checked = !0),
                (document.querySelector("#switcher-background4").checked = !0);
        }),
        dt.addEventListener("click", () => {
            n.setAttribute("bg-img", "bgimg1"),
                localStorage.setItem("bgimg", "bgimg1");
        }),
        ut.addEventListener("click", () => {
            n.setAttribute("bg-img", "bgimg2"),
                localStorage.setItem("bgimg", "bgimg2");
        }),
        mt.addEventListener("click", () => {
            n.setAttribute("bg-img", "bgimg3"),
                localStorage.setItem("bgimg", "bgimg3");
        }),
        ht.addEventListener("click", () => {
            n.setAttribute("bg-img", "bgimg4"),
                localStorage.setItem("bgimg", "bgimg4");
        }),
        yt.addEventListener("click", () => {
            n.setAttribute("bg-img", "bgimg5"),
                localStorage.setItem("bgimg", "bgimg5");
        }),
        l.addEventListener("click", () => {
            Yt(),
                localStorage.setItem("ynexHeader", "light"),
                localStorage.removeItem("darkBgRGB"),
                localStorage.removeItem("bodyBgRGB"),
                localStorage.removeItem("ynexMenu");
        }),
        s.addEventListener("click", () => {
            ro(),
                localStorage.setItem("ynexMenu", "dark"),
                localStorage.setItem("ynexHeader", "dark"),
                localStorage.setItem("hs_theme", "dark"),
                localStorage.removeItem("hs_theme", "light");
        }),
        k.addEventListener("click", () => {
            n.setAttribute("data-menu-styles", "light"),
                localStorage.setItem("ynexMenu", "light");
        }),
        z.addEventListener("click", () => {
            n.setAttribute("data-menu-styles", "color"),
                localStorage.setItem("ynexMenu", "color");
        }),
        G.addEventListener("click", () => {
            n.setAttribute("data-menu-styles", "dark"),
                localStorage.setItem("ynexMenu", "dark");
        }),
        Fe.addEventListener("click", () => {
            n.setAttribute("data-menu-styles", "gradient"),
                localStorage.setItem("ynexMenu", "gradient");
        }),
        $e.addEventListener("click", () => {
            n.setAttribute("data-menu-styles", "transparent"),
                localStorage.setItem("ynexMenu", "transparent");
        }),
        f.addEventListener("click", () => {
            n.setAttribute("data-header-styles", "light"),
                localStorage.setItem("ynexHeader", "light");
        }),
        E.addEventListener("click", () => {
            n.setAttribute("data-header-styles", "color"),
                localStorage.setItem("ynexHeader", "color");
        }),
        B.addEventListener("click", () => {
            n.setAttribute("data-header-styles", "dark"),
                localStorage.setItem("ynexHeader", "dark");
        }),
        i.addEventListener("click", () => {
            n.setAttribute("data-header-styles", "gradient"),
                localStorage.setItem("ynexHeader", "gradient");
        }),
        ze.addEventListener("click", () => {
            n.setAttribute("data-header-styles", "transparent"),
                localStorage.setItem("ynexHeader", "transparent");
        }),
        p.addEventListener("click", () => {
            n.setAttribute("data-width", "fullwidth"),
                localStorage.setItem("ynexfullwidth", !0),
                localStorage.removeItem("ynexboxed");
        }),
        h.addEventListener("click", () => {
            n.setAttribute("data-width", "boxed"),
                localStorage.setItem("ynexboxed", !0),
                localStorage.removeItem("ynexfullwidth"),
                Oe();
        }),
        We.addEventListener("click", () => {
            n.setAttribute("data-page-style", "regular"),
                localStorage.setItem("ynexregular", !0),
                localStorage.removeItem("ynexclassic"),
                localStorage.removeItem("ynexmodern");
        }),
        Ge.addEventListener("click", () => {
            n.setAttribute("data-page-style", "classic"),
                localStorage.setItem("ynexclassic", !0),
                localStorage.removeItem("ynexregular");
        }),
        Je.addEventListener("click", () => {
            n.setAttribute("data-page-style", "modern"),
                localStorage.setItem("ynexmodern", !0),
                localStorage.removeItem("ynexregular"),
                localStorage.removeItem("ynexclassic");
        }),
        P.addEventListener("click", () => {
            n.setAttribute("data-header-position", "fixed"),
                localStorage.setItem("ynexheaderfixed", !0),
                localStorage.removeItem("ynexheaderscrollable");
        }),
        q.addEventListener("click", () => {
            n.setAttribute("data-header-position", "scrollable"),
                localStorage.setItem("ynexheaderscrollable", !0),
                localStorage.removeItem("ynexheaderfixed");
        }),
        d.addEventListener("click", () => {
            n.setAttribute("data-menu-position", "fixed"),
                localStorage.setItem("ynexmenufixed", !0),
                localStorage.removeItem("ynexmenuscrollable");
        }),
        v.addEventListener("click", () => {
            n.setAttribute("data-menu-position", "scrollable"),
                localStorage.setItem("ynexmenuscrollable", !0),
                localStorage.removeItem("ynexmenufixed");
        }),
        Ne.addEventListener("click", () => {
            n.setAttribute("data-vertical-style", "default"),
                n.setAttribute("data-nav-layout", "vertical"),
                L(),
                localStorage.removeItem("ynexverticalstyles"),
                document.querySelectorAll(".main-menu>li.open").forEach((c) => {
                    c.classList.contains("active") ||
                        (c.classList.remove("open"),
                        (c.querySelector("ul").style.display = "none"));
                });
        }),
        Ye.addEventListener("click", () => {
            Wr(),
                localStorage.setItem("ynexverticalstyles", "closed"),
                document.querySelectorAll(".main-menu>li.open").forEach((c) => {
                    c.classList.contains("active") ||
                        (c.classList.remove("open"),
                        (c.querySelector("ul").style.display = "none"));
                });
        }),
        Xe.addEventListener("click", () => {
            Gr(), localStorage.setItem("ynexverticalstyles", "detached");
        }),
        _e.addEventListener("click", () => {
            Jr(), localStorage.setItem("ynexverticalstyles", "icontext");
        }),
        je.addEventListener("click", () => {
            Re(),
                localStorage.setItem("ynexverticalstyles", "overlay"),
                document.querySelectorAll(".main-menu>li.open").forEach((c) => {
                    c.classList.contains("active") ||
                        (c.classList.remove("open"),
                        (c.querySelector("ul").style.display = "none"));
                });
        }),
        Ue.addEventListener("click", () => {
            Nr(), localStorage.setItem("ynexverticalstyles", "doublemenu");
        }),
        Ke.addEventListener("click", () => {
            n.removeAttribute("data-vertical-style"),
                Yr(),
                localStorage.setItem("ynexnavstyles", "menu-click"),
                localStorage.removeItem("ynexverticalstyles"),
                document.querySelectorAll(".main-menu>li.open").forEach((c) => {
                    c.classList.contains("active") ||
                        (c.classList.remove("open"),
                        (c.querySelector("ul").style.display = "none"));
                }),
                document
                    .querySelector("html")
                    .getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft =
                        "0px"),
                    (document.querySelector(".main-menu").style.marginRight =
                        "0px"),
                    W());
        }),
        Qe.addEventListener("click", () => {
            n.removeAttribute("data-vertical-style"),
                _r(),
                localStorage.setItem("ynexnavstyles", "menu-hover"),
                localStorage.removeItem("ynexverticalstyles"),
                document
                    .querySelector("html")
                    .getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft =
                        "0px"),
                    (document.querySelector(".main-menu").style.marginRight =
                        "0px"),
                    W());
        }),
        Ze.addEventListener("click", () => {
            n.removeAttribute("data-vertical-style"),
                Xr(),
                localStorage.setItem("ynexnavstyles", "icon-click"),
                localStorage.removeItem("ynexverticalstyles"),
                document
                    .querySelector("html")
                    .getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft =
                        "0px"),
                    (document.querySelector(".main-menu").style.marginRight =
                        "0px"),
                    W(),
                    document
                        .querySelector("#slide-left")
                        .classList.add("d-none")),
                document.querySelectorAll(".main-menu>li.open").forEach((c) => {
                    c.classList.contains("active") ||
                        (c.classList.remove("open"),
                        (c.querySelector("ul").style.display = "none"));
                });
        }),
        Ve.addEventListener("click", () => {
            n.removeAttribute("data-vertical-style"),
                jr(),
                localStorage.setItem("ynexnavstyles", "icon-hover"),
                localStorage.removeItem("ynexverticalstyles"),
                document
                    .querySelector("html")
                    .getAttribute("data-nav-layout") == "horizontal" &&
                    ((document.querySelector(".main-menu").style.marginLeft =
                        "0px"),
                    (document.querySelector(".main-menu").style.marginRight =
                        "0px"),
                    W(),
                    document
                        .querySelector("#slide-left")
                        .classList.add("d-none"));
        }),
        o.addEventListener("click", () => {
            let c = document.querySelector(".main-content");
            localStorage.removeItem("ynexlayout"),
                localStorage.setItem("ynexverticalstyles", "default"),
                _t(),
                R(),
                c.removeEventListener("click", w),
                (document.querySelector(".main-menu").style.marginLeft = "0px"),
                (document.querySelector(".main-menu").style.marginRight =
                    "0px"),
                document.querySelectorAll(".slide").forEach((le) => {
                    le.classList.contains("open") &&
                        !le.classList.contains("active") &&
                        (le.querySelector("ul").style.display = "none");
                });
        }),
        a.addEventListener("click", () => {
            let c = document.querySelector(".main-content");
            n.removeAttribute("data-vertical-style"),
                localStorage.setItem("ynexlayout", "horizontal"),
                localStorage.removeItem("ynexverticalstyles"),
                oo(),
                w(),
                c.addEventListener("click", w);
        }),
  

r.addEventListener("click", () => {
    localStorage.setItem("ynexrtl", true);
    localStorage.removeItem("ynexltr");
    to();

    if (document.querySelector(".noUi-target")) {
        console.log("working");
        document.querySelectorAll(".noUi-origin").forEach((c) => {
            c.classList.add("!transform-none");
        });
    }

    changeLanguage("rtl");
});

t.addEventListener("click", () => {
    localStorage.setItem("ynexltr", true);
    localStorage.removeItem("ynexrtl");
    Nt();

    if (document.querySelector(".noUi-target")) {
        document.querySelectorAll(".noUi-origin").forEach((c) => {
            c.classList.add("!transform-none");
        });
    }

    changeLanguage("ltr");
});

        ft.addEventListener("click", () => {
            ao(),
                R(),
                document
                    .querySelector("html")
                    .setAttribute("data-menu-styles", "dark"),
                (document.querySelector("#switcher-menu-dark").checked = !0),
                document.querySelectorAll(".slide").forEach((c) => {
                    c.classList.contains("open") &&
                        !c.classList.contains("active") &&
                        (c.querySelector("ul").style.display = "none");
                });
        });
    document.addEventListener("DOMContentLoaded", () => {
        if (!localStorage.getItem("loaderEnable")) {
            document.querySelector("html").setAttribute("loader", "enable");
            localStorage.setItem("loaderEnable", "true");
        } else if (localStorage.getItem("loaderEnable") === "true") {
            document.querySelector("html").setAttribute("loader", "enable");
        }
    });
}
  const changeLanguage = (lang) => {
                  window.location.reload(); 

      const csrfToken = document.querySelector(
          'meta[name="csrf-token"]'
      ).content;

      return fetch("/change-language", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({ lang }),
      })
          .then((response) => {
              if (!response.ok) {
                  throw new Error("Network response was not ok");
              }
              return response.json();
          })
          .then((data) => {
              console.log(data.message);
          })
          .catch((error) => {
              console.error("Error:", error);
          });
  };
function Nt() {
    document.querySelector("html").setAttribute("dir", "ltr"),
        (document.querySelector("#switcher-ltr").checked = !0),
        C();
}
function to() {
    document.querySelector("html").setAttribute("dir", "rtl"), C();
}
function Yt() {
    let t = document.querySelector("html");
    t.setAttribute("class", "light"),
        t.setAttribute("data-header-styles", "light"),
        t.setAttribute("data-menu-styles", "dark"),
        localStorage.getItem("ynexlayout") == "horizontal" &&
            t.setAttribute("data-menu-styles", "light"),
        localStorage.getItem("primaryRGB") || t.setAttribute("style", ""),
        (document.querySelector("#switcher-light-theme").checked = !0),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-menu-light").checked = !1),
        (document.querySelector("#switcher-header-light").checked = !0),
        I(),
        localStorage.removeItem("ynexdarktheme"),
        localStorage.removeItem("ynexbgColor"),
        localStorage.removeItem("ynexheaderbg"),
        localStorage.removeItem("ynexbgwhite"),
        localStorage.removeItem("ynexmenubg"),
        localStorage.removeItem("ynexmenubg"),
        localStorage.removeItem("hs_theme"),
        C(),
        t.style.removeProperty("--body-bg-rgb"),
        t.style.removeProperty("--body-bg-rgb2"),
        t.style.removeProperty("--body-bg"),
        t.style.removeProperty("--dark-bg"),
        t.style.removeProperty("--light"),
        t.style.removeProperty("--form-control-bg"),
        t.style.removeProperty("--input-border"),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-menu-light").checked = !1),
        (document.querySelector("#switcher-header-light").checked = !0);
}
function ro() {
    let t = document.querySelector("html");
    t.setAttribute("class", "dark"),
        t.setAttribute("data-header-styles", "dark"),
        t.setAttribute("data-menu-styles", "dark"),
        localStorage.getItem("primaryRGB") || t.setAttribute("style", ""),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0),
        document.querySelector("html").style.removeProperty("--body-bg-rgb"),
        document.querySelector("html").style.removeProperty("--body-bg-rgb2"),
        document.querySelector("html").style.removeProperty("--body-bg"),
        document.querySelector("html").style.removeProperty("--dark-bg"),
        document.querySelector("html").style.removeProperty("--light"),
        document
            .querySelector("html")
            .style.removeProperty("--form-control-bg"),
        document.querySelector("html").style.removeProperty("--input-border"),
        I(),
        localStorage.setItem("ynexdarktheme", !0),
        localStorage.removeItem("ynexlighttheme"),
        localStorage.removeItem("bodyBgRGB"),
        localStorage.removeItem("ynexbgColor"),
        localStorage.removeItem("ynexheaderbg"),
        localStorage.removeItem("ynexbgwhite"),
        localStorage.removeItem("ynexmenubg"),
        localStorage.removeItem("hs_theme"),
        C(),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0);
}
function _t() {
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "vertical"),
        t.setAttribute("data-vertical-style", "overlay"),
        t.removeAttribute("data-nav-style"),
        localStorage.removeItem("ynexnavstyles"),
        t.removeAttribute("data-toggled"),
        (document.querySelector("#switcher-vertical").checked = !0),
        (document.querySelector("#switcher-menu-click").checked = !1),
        (document.querySelector("#switcher-menu-hover").checked = !1),
        (document.querySelector("#switcher-icon-click").checked = !1),
        (document.querySelector("#switcher-icon-hover").checked = !1),
        C(),
        localStorage.ynexMenu || t.setAttribute("data-menu-styles", "dark");
}
function oo() {
    (document.querySelector("#switcher-horizontal").checked = !0),
        (document.querySelector("#switcher-menu-click").checked = !0);
    let t = document.querySelector("html");
    t.setAttribute("data-nav-layout", "horizontal"),
        t.removeAttribute("data-vertical-style"),
        t.getAttribute("data-nav-style") ||
            t.setAttribute("data-nav-style", "menu-click"),
        !localStorage.ynexMenu &&
            !localStorage.darkBgRGB &&
            (t.setAttribute("data-menu-styles", "light"),
            (document.querySelector("#switcher-menu-light").checked = !0),
            C()),
        C(),
        Oe();
}
function ao() {
    let t = document.querySelector("html");
    localStorage.getItem("ynexlayout") == "horizontal" &&
        (document.querySelector(".main-menu").style.display = "block"),
        C(),
        localStorage.clear(),
        Yt(),
        document.querySelector("html").removeAttribute("style"),
        t.removeAttribute("data-nav-style"),
        t.removeAttribute("data-menu-position"),
        t.removeAttribute("data-header-position"),
        t.removeAttribute("data-width"),
        t.removeAttribute("data-page-style"),
        t.removeAttribute("bg-img"),
        t.style.removeProperty("--primary"),
        t.style.removeProperty("--body-bg-rgb"),
        Nt(),
        _t(),
        Jt.removeEventListener("click", w),
        (document.querySelector("#switcher-classic").checked = !1),
        (document.querySelector("#switcher-modern").checked = !1),
        (document.querySelector("#switcher-regular").checked = !0),
        (document.querySelector("#switcher-full-width").checked = !0),
        (document.querySelector("#switcher-boxed").checked = !1),
        (document.querySelector("#switcher-menu-fixed").checked = !0),
        (document.querySelector("#switcher-menu-scroll").checked = !1),
        (document.querySelector("#switcher-header-fixed").checked = !0),
        (document.querySelector("#switcher-header-scroll").checked = !1),
        (document.querySelector("#switcher-default-menu").checked = !0),
        (document.querySelector("#switcher-closed-menu").checked = !1),
        (document.querySelector("#switcher-icontext-menu").checked = !1),
        (document.querySelector("#switcher-icon-overlay").checked = !1),
        (document.querySelector("#switcher-detached").checked = !1),
        (document.querySelector("#switcher-double-menu").checked = !1),
        (document.querySelector("#switcher-primary").checked = !1),
        (document.querySelector("#switcher-primary1").checked = !1),
        (document.querySelector("#switcher-primary2").checked = !1),
        (document.querySelector("#switcher-primary3").checked = !1),
        (document.querySelector("#switcher-primary4").checked = !1),
        (document.querySelector("#switcher-background").checked = !1),
        (document.querySelector("#switcher-background1").checked = !1),
        (document.querySelector("#switcher-background2").checked = !1),
        (document.querySelector("#switcher-background3").checked = !1),
        (document.querySelector("#switcher-background4").checked = !1),
        (document.querySelector("#switcher-bg-img").checked = !1),
        (document.querySelector("#switcher-bg-img1").checked = !1),
        (document.querySelector("#switcher-bg-img2").checked = !1),
        (document.querySelector("#switcher-bg-img3").checked = !1),
        (document.querySelector("#switcher-bg-img4").checked = !1),
        I(),
        (document.querySelector(".main-menu").style.marginLeft = "0px"),
        (document.querySelector(".main-menu").style.marginRight = "0px");
}
function C() {
    if (
        (localStorage.getItem("ynexdarktheme") &&
            (document.querySelector("#switcher-dark-theme").checked = !0),
        localStorage.getItem("ynexlayout") === "horizontal"
            ? ((document.querySelector("#switcher-horizontal").checked = !0),   
              (document.querySelector("#switcher-menu-click").checked = !0))
            : (document.querySelector("#switcher-vertical").checked = !0),
        localStorage.getItem("ynexrtl")
            ? (document.querySelector("#switcher-rtl").checked = !0)
            : (document.querySelector("#switcher-ltr").checked = !0),
        localStorage.getItem("ynexHeader") === "light" &&
            (document.querySelector("#switcher-header-light").checked = !0),
        localStorage.getItem("ynexHeader") === "color" &&
            (document.querySelector("#switcher-header-primary").checked = !0),
        localStorage.getItem("ynexHeader") === "gradient" &&
            (document.querySelector("#switcher-header-gradient").checked = !0),
        localStorage.getItem("ynexHeader") === "dark" &&
            (document.querySelector("#switcher-header-dark").checked = !0),
        localStorage.getItem("ynexHeader") === "transparent" &&
            (document.querySelector("#switcher-header-transparent").checked =
                !0),
        localStorage.getItem("ynexMenu") === "light" &&
            (document.querySelector("#switcher-menu-light").checked = !0),
        localStorage.getItem("ynexMenu") === "color" &&
            (document.querySelector("#switcher-menu-primary").checked = !0),
        localStorage.getItem("ynexMenu") === "gradient" &&
            (document.querySelector("#switcher-menu-gradient").checked = !0),
        localStorage.getItem("ynexMenu") === "dark" &&
            (document.querySelector("#switcher-menu-dark").checked = !0),
        localStorage.getItem("ynexMenu") === "transparent" &&
            (document.querySelector("#switcher-menu-transparent").checked = !0),
        localStorage.getItem("ynexboxed") &&
            (document.querySelector("#switcher-boxed").checked = !0),
        localStorage.getItem("ynexheaderscrollable") &&
            (document.querySelector("#switcher-header-scroll").checked = !0),
        localStorage.getItem("ynexmenuscrollable") &&
            (document.querySelector("#switcher-menu-scroll").checked = !0),
        localStorage.getItem("ynexheaderfixed") &&
            (document.querySelector("#switcher-header-fixed").checked = !0),
        localStorage.getItem("ynexmenufixed") &&
            (document.querySelector("#switcher-menu-fixed").checked = !0),
        localStorage.getItem("ynexclassic") &&
            (document.querySelector("#switcher-classic").checked = !0),
        localStorage.getItem("ynexmodern") &&
            (document.querySelector("#switcher-modern").checked = !0),
        localStorage.ynexverticalstyles)
    )
        switch (localStorage.getItem("ynexverticalstyles")) {
            case "default":
                document.querySelector("#switcher-default-menu").checked = !0;
                break;
            case "closed":
                document.querySelector("#switcher-closed-menu").checked = !0;
                break;
            case "icontext":
                document.querySelector("#switcher-icontext-menu").checked = !0;
                break;
            case "overlay":
                document.querySelector("#switcher-icon-overlay").checked = !0;
                break;
            case "detached":
                document.querySelector("#switcher-detached").checked = !0;
                break;
            case "doublemenu":
                document.querySelector("#switcher-double-menu").checked = !0;
                break;
            default:
                document.querySelector("#switcher-default-menu").checked = !0;
                break;
        }
    if (localStorage.ynexnavstyles)
        switch (localStorage.getItem("ynexnavstyles")) {
            case "menu-click":
                document.querySelector("#switcher-menu-click").checked = !0;
                break;
            case "menu-hover":
                document.querySelector("#switcher-menu-hover").checked = !0;
                break;
            case "icon-click":
                document.querySelector("#switcher-icon-click").checked = !0;
                break;
            case "icon-hover":
                document.querySelector("#switcher-icon-hover").checked = !0;
                break;
        }
}
let u, vt;
function I() {
    (vt = getComputedStyle(document.documentElement)
        .getPropertyValue("--primary-rgb")
        .trim()),
        (u = localStorage.getItem("primaryRGB") || vt),
        document.querySelector("#crm-total-customers") !== null && Ut(u),
        document.querySelector("#crm-revenue-analytics") !== null && Kt(u),
        document.querySelector("#crm-profits-earned") !== null && Zt(u),
        document.querySelector("#leads-source") !== null && Vt(u),
        document.querySelector("#earnings") !== null && tr(u),
        document.querySelector("#crypto") !== null && or(u),
        document.querySelector("#subscriptionOverview") !== null && ar(u),
        document.querySelector("#candidates-chart") !== null && lr(u),
        document.querySelector("#nft-balance-chart") !== null && nr(u),
        document.querySelector("#nft-statistics") !== null && ir(u),
        document.querySelector("#salesOverview") !== null && cr(u),
        document.querySelector("#sale-value") !== null && ur(u),
        document.querySelector("#analytics-bouncerate") !== null && mr(u),
        document.querySelector("#sessions") !== null && hr(u),
        document.querySelector("#audienceReport") !== null && yr(u),
        document.querySelector("#country-sessions") !== null && fr(u),
        document.querySelector("#session-users") !== null && pr(u),
        document.querySelector("#projectAnalysis") !== null && Sr(u),
        document.querySelector("#performanceReport") !== null && xr(u),
        document.querySelector("#jobs-summary") !== null && kr(u),
        document.querySelector("#total-invested") !== null && qr(u),
        document.querySelector("#totalInvestmentsStats") !== null && Ar(u),
        document.querySelector("#stocks-marketcap") !== null && Lr(u),
        document.querySelector("#courses-earnings") !== null && Ir(u),
        document.querySelector("#course-payouts") !== null && Cr(u),
        document.querySelector("#waterTrack") !== null && Mr(u),
        document.querySelector("#report") !== null && Tr(u),
        document.querySelector("#views") !== null && Rr(u);
}
if (document.querySelector("#hs-overlay-switcher")) {
    const t = document.querySelector(".pickr-container-primary"),
        r = document.querySelector(".theme-container-primary"),
        o = document.querySelector(".pickr-container-background"),
        a = document.querySelector(".theme-container-background"),
        l = [
            [
                "nano",
                {
                    defaultRepresentation: "RGB",
                    components: {
                        preview: !0,
                        opacity: !1,
                        hue: !0,
                        interaction: {
                            hex: !1,
                            rgba: !0,
                            hsva: !1,
                            input: !0,
                            clear: !1,
                            save: !1,
                        },
                    },
                },
            ],
        ],
        s = [];
    let h = null;
    for (const [v, P] of l) {
        const d = document.createElement("button");
        (d.innerHTML = v),
            s.push(d),
            d.addEventListener("click", () => {
                const f = document.createElement("p");
                t.appendChild(f), h && h.destroyAndRemove();
                for (const B of s)
                    B.classList[B === d ? "add" : "remove"]("active");
                (h = new Pickr(
                    Object.assign({ el: f, theme: v, default: "#845adf" }, P)
                )),
                    h.on("changestop", (B, E) => {
                        let i = E.getColor().toRGBA(),
                            k = document.querySelector("html");
                        k.style.setProperty(
                            "--primary",
                            `${Math.floor(i[0])} ${Math.floor(
                                i[1]
                            )} ${Math.floor(i[2])}`
                        ),
                            k.style.setProperty(
                                "--color-primary-rgb",
                                `${Math.floor(i[0])} ,${Math.floor(
                                    i[1]
                                )}, ${Math.floor(i[2])}`
                            ),
                            localStorage.setItem(
                                "primaryRGB",
                                `${Math.floor(i[0])}, ${Math.floor(
                                    i[1]
                                )}, ${Math.floor(i[2])}`
                            ),
                            localStorage.setItem(
                                "primaryRGB1",
                                `${Math.floor(i[0])} ${Math.floor(
                                    i[1]
                                )} ${Math.floor(i[2])}`
                            ),
                            I();
                    });
            }),
            r.appendChild(d);
    }
    s[0].click();
    const p = [];
    let q = null;
    for (const [v, P] of l) {
        const d = document.createElement("button");
        (d.innerHTML = v),
            p.push(d),
            d.addEventListener("click", () => {
                const f = document.createElement("p");
                o.appendChild(f), q && q.destroyAndRemove();
                for (const B of s)
                    B.classList[B === d ? "add" : "remove"]("active");
                (q = new Pickr(
                    Object.assign({ el: f, theme: v, default: "#845adf" }, P)
                )),
                    q.on("changestop", (B, E) => {
                        let i = E.getColor().toRGBA(),
                            k = document.querySelector("html");
                        k.style.setProperty(
                            "--body-bg",
                            `${Math.floor(i[0] + 14)}
             ${Math.floor(i[1] + 14)}
              ${Math.floor(i[2] + 14)}`
                        ),
                            k.style.setProperty(
                                "--dark-bg",
                                `
            ${Math.floor(i[0])}
            ${Math.floor(i[1])}
            ${Math.floor(i[2])}
            `
                            ),
                            k.style.setProperty(
                                "--light",
                                `
            ${Math.floor(i[0] + 5)}
            ${Math.floor(i[1] + 5)}
            ${Math.floor(i[2] + 5)}
            `
                            ),
                            localStorage.removeItem("bgtheme"),
                            I(),
                            k.classList.add("dark"),
                            k.classList.remove("light"),
                            k.setAttribute("data-menu-styles", "dark"),
                            k.setAttribute("data-header-styles", "dark"),
                            (document.querySelector(
                                "#switcher-dark-theme"
                            ).checked = !0),
                            localStorage.setItem(
                                "bodyBgRGB",
                                `${Math.floor(i[0] + 14)}
             ${Math.floor(i[1] + 14)}
              ${Math.floor(i[2] + 14)}`
                            ),
                            localStorage.setItem(
                                "--light",
                                `${Math.floor(i[0] + 5)}
             ${Math.floor(i[1] + 5)}
              ${Math.floor(i[2] + 5)}`
                            ),
                            localStorage.setItem(
                                "darkBgRGB",
                                `${Math.floor(i[0])} ${Math.floor(
                                    i[1]
                                )} ${Math.floor(i[2])}`
                            );
                    });
            }),
            a.appendChild(d);
    }
    p[0].click();
}
I();
function lo() {
    (localStorage.bodyBgRGB || localStorage.darkBgRGB) &&
        ((document.querySelector("#switcher-dark-theme").checked = !0),
        (document.querySelector("#switcher-menu-dark").checked = !0),
        (document.querySelector("#switcher-header-dark").checked = !0)),
        localStorage.bodyBgRGB &&
            localStorage.darkBgRGB &&
            (localStorage.bodyBgRGB == "34 44 110" &&
                (document.querySelector("#switcher-background").checked = !0),
            localStorage.bodyBgRGB == "22 92 129" &&
                (document.querySelector("#switcher-background1").checked = !0),
            localStorage.bodyBgRGB == "104 51 149" &&
                (document.querySelector("#switcher-background2").checked = !0),
            localStorage.bodyBgRGB == "38 115 64" &&
                (document.querySelector("#switcher-background3").checked = !0),
            localStorage.bodyBgRGB == "134 80 34" &&
                (document.querySelector("#switcher-background4").checked = !0)),
        localStorage.primaryRGB &&
            (localStorage.primaryRGB == "58, 88, 146" &&
                (document.querySelector("#switcher-primary").checked = !0),
            localStorage.primaryRGB == "92, 144, 163" &&
                (document.querySelector("#switcher-primary1").checked = !0),
            localStorage.primaryRGB == "161, 90, 223" &&
                (document.querySelector("#switcher-primary2").checked = !0),
            localStorage.primaryRGB == "78, 172, 76" &&
                (document.querySelector("#switcher-primary3").checked = !0),
            localStorage.primaryRGB == "223, 90, 90" &&
                (document.querySelector("#switcher-primary4").checked = !0));
}
