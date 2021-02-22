@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-nav-tabs text-center my-5">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title">Solicitações de reserva</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-pills-icons" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
                                    <i class="material-icons">dashboard</i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#schedule-1" role="tab" data-toggle="tab">
                                    <i class="material-icons">schedule</i>
                                    Schedule
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab">
                                    <i class="material-icons">list</i>
                                    Tasks
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content tab-space">
                            <div class="tab-pane active" id="dashboard-1">
                                Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.
                                <br><br>
                                Dramatically visualize customer directed convergence without revolutionary ROI.
                            </div>
                            <div class="tab-pane" id="schedule-1">
                                Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
                                <br><br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                            </div>
                            <div class="tab-pane" id="tasks-1">
                                Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.
                                <br><br>Dynamically innovate resource-leveling customer service for state of the art customer service.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
