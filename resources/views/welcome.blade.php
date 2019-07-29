<html>
    <head>
        <title>IntegratedBooking | Universitas Gadjah Mada</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/css/ugmtheme.css" rel="stylesheet" type="text/css">        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>           
    </head>

    <body style="background-color:#E6E6E6">

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        <img src="/images/ugm_logo.png" class="image-responsive">
                        <span>Universitas Gadjah Mada</span>
                    </a>
                </div>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="/login">Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="header">
            <div class="container">
                <div class="banner">
                    <h1>IntegratedBooking<span style="color:#f0ad4e;"> ClassRoom</span> <small> | Universitas Gadjah Mada</small></h1>
                    <h5>Sistem integrasi penggunaan ruangan di Universitas Gadjah Mada</h5>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="container">
            <div class="main-wrapper">


                <div class="clearfix"></div>
                <div class="row" style="margin:auto;">
                    <div class="col-sm-12">                    
                        <div id="scheduler"></div>
                    </div>
                </div>		
                <br>
                
                
                <!-- </div> -->
                <!-- End ImageReady Slices -->
            </div>
        </div>
        <div id="info-box"></div>               
        <script src="/js/bootstrap.min.js"></script>
        <script src="/build/aui/aui.js"></script>
        <script>
        YUI({ filter: 'raw' }).use('aui-scheduler', function(Y) {

        var items = [
            {
                content: 'Wake Early'
            },
            {
                content: 'Exercise'
            },
            {
                content: 'Review or (even better) Rewrite Your Goals',
                startDate: new Date(2013, 1, 4, 12),
                endDate: new Date(2013, 1, 4, 16)
            },            
        ];

        var schedulerViews = [
            new Y.SchedulerWeekView(),
            new Y.SchedulerDayView(),
            new Y.SchedulerMonthView(),
            new Y.SchedulerAgendaView()
        ];

        new Y.Scheduler({
            boundingBox: '#scheduler',
            items: items,
            views: schedulerViews,
            activeView: schedulerViews[2],            
            // firstDayOfWeek: 1,
            // activeView: weekView,
            // views: [dayView, weekView, monthView, agendaView]
        }).render();

    });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5abc44524b401e45400e29f4/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    </body>
</html>