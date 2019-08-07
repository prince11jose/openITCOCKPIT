/**
 * @link https://fullcalendar.io/docs/upgrading-from-v3
 */
angular.module('openITCOCKPIT')
    .controller('CalendarsAddController', function($scope, $http, $state, $stateParams, NotyService, RedirectService){

        $scope.data = {
            createAnother: false
        };

        $scope.defaultDate = new Date();
        $scope.countryCode = 'de';

        var clearForm = function(){
            $scope.post = {
                Calendar: {
                    container_id: 0,
                    name: '',
                    description: ''
                }
            };
        };
        clearForm();

        $scope.calendar = null;
        /**
         *  {
                daysOfWeek: [6], //Saturdays
                rendering: "background",
                color: "#bbdefb ",
                overLap: false,
                allDay: true
            },
         {
                daysOfWeek: [0], //Sundays
                rendering: "background",
                color: "#90caf9",
                overLap: false,
                allDay: true
            },
         * @type {*[]}
         */
        $scope.events = [];

        $scope.init = true;

        var renderCalendar = function(){
            var calendarEl = document.getElementById('calendar');

            $scope.calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                customButtons: {
                    holidays: {
                        text: 'Add holidays ',
                    },
                    deleteallholidays: {
                        text: 'Delete ALL holidays',
                        click: function(){
                            alert('clicked the custom button!');
                        }
                    },
                    deletemonthevents: {
                        text: 'Delete MONTH events',
                        click: function(){
                            alert('clicked the custom button!');
                        }
                    },
                    deleteallevents: {
                        text: 'Delete ALL events',
                        click: function(){
                            alert('clicked the custom button!');
                        }
                    }
                },
                header: {
                    left: 'holidays deleteallholidays deletemonthevents deleteallevents',
                    center: 'title',
                    right: 'prev,next today',
                },
                defaultDate: $scope.defaultDate,
                navLinks: false, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                weekNumbers: true,
                weekNumbersWithinDays: false,
                weekNumberCalculation: 'ISO',
                eventOverlap: false,
                eventDurationEditable: false,
                datesRender: function(info){
                    //Update default date to avoid "jumping" calendar on add/delete of events
                    $scope.defaultDate = info.view.currentStart;

                    $(".fc-day-number").each(function(index, obj){
                        //obj = fc-day-number <span>
                        var $span = $(obj);
                        var $parentTd = $span.parent();
                        var currentDate = $parentTd.data('date');

                        var $addButton = $('<button>')
                            .html('<i class="fa fa-plus"></i>')
                            .attr({
                                title: 'add',
                                type: 'button',
                                class: 'btn btn-xs btn-success calendar-button'
                            })
                            .click(function(){
                                    $('#addEventModal').modal('show');
                                    $scope.newEvent = {
                                        title: '',
                                        start: currentDate
                                    };
                                }
                            );

                        var events = $scope.getEvents(currentDate);
                        if(!$scope.hasEvents(currentDate)){
                            $parentTd.css('text-align', 'right').append($addButton);
                        }
                    });
                },
                eventPositioned: function(info){
                    var elements = $('[data-date="' + date('Y-m-d', info.event.start) + '"]');

                    var $editButton = $('<button>')
                        .html('<i class="fa fa-pencil"></i>')
                        .attr({
                            title: 'edit',
                            type: 'button',
                            class: 'btn btn-xs btn-primary btn-edit calendar-button margin-right-5'
                        })
                        .click(function(){
                                var event = $scope.getEvents(date('Y-m-d', info.event.start));
                                $scope.editEvent = {
                                    start: event.start,
                                    title: event.title
                                };
                                $scope.$apply();
                                $('#editEventModal').modal('show');
                            }
                        );

                    var $deleteButton = $('<button>')
                        .html('<i class="fa fa-trash-o"></i>')
                        .attr({
                            title: 'delete',
                            type: 'button',
                            class: 'btn btn-xs btn-danger calendar-button'
                        })
                        .click(function(){
                                $scope.deleteEvent(date('Y-m-d', info.event.start));
                                $scope.$apply();
                            }
                        );

                    $(elements[1]).css('text-align', 'right').append($deleteButton);
                    $(elements[1]).append($editButton);
                },

                eventDrop: function(info){
                    //Move event in json
                    var event = $scope.deleteEvent(date('Y-m-d', info.oldEvent.start));
                    if(!event){
                        return;
                    }
                    event = event[0];

                    //Set new start date
                    event.start = date('Y-m-d', info.event.start);

                    //Add event back to json
                    $scope.addEvent(event.title, event.start);

                    $scope.$apply();
                },
                events: $scope.events
            });

            $scope.calendar.render();
        };

        $scope.loadHolidays = function(){
            $http.get('/calendars/loadHolidays/' + $scope.countryCode + '.json', {
                params: {
                    'angular': true
                }
            }).then(function(result){
                $scope.init = false;
                $scope.events = result.data.holidays;
                renderCalendar();
                setTimeout(function(){
                    $(".fc-holidays-button").wrap("<span class='dropdown'></span>");
                    $('.fc-holidays-button').addClass('btn btn-secondary dropdown-toggle');
                    $('.fc-holidays-button').attr({
                        'data-toggle': 'dropdown',
                        'type': 'button',
                        'aria-expanded': false,
                        'id': 'dropdownMenuButton'
                    }).append('<span class="caret"></span>');
                    $('.fc-holidays-button').parent().append('<ul class="dropdown-menu">' +
                        '<li><a class="dropdown-item" href="#"><img class="flag flag-de"> Germany</a></li>\n' +
                        '    <li><a href="#"><img class="flag flag-us"> USA</a></li>\n' +
                        '    <li><a href="#"><img class="flag flag-se"> Sweden</a></li>\n' +
                        '  </ul>');

                }, 1000);
            });
        };

        $scope.load = function(){
            $http.get("/containers/loadContainersForAngular.json", {
                params: {
                    'angular': true
                }
            }).then(function(result){
                $scope.containers = result.data.containers;
                $scope.init = false;
            });
        };

        $scope.getEvents = function(date){
            for(var index in $scope.events){
                if($scope.events[index].start === date){
                    return $scope.events[index]
                }
            }
            return null;
        };

        $scope.hasEvents = function(date){
            for(var index in $scope.events){
                if($scope.events[index].start === date){
                    return true;
                }
            }
            return false;
        };

        $scope.deleteEvent = function(date){
            for(var index in $scope.events){
                if($scope.events[index].start === date){
                    return $scope.events.splice(index, 1);
                }
            }
            return false;
        };

        $scope.addEvent = function(title, date){
            $scope.events.push({
                title: title,
                start: date,
                default_holiday: 0,
                className: 'bg-color-pinkDark'
            });
        };

        $scope.addEventFromModal = function(){
            if($scope.newEvent.title === ''){
                return;
            }

            //Add event to internal json
            $scope.addEvent($scope.newEvent.title, $scope.newEvent.start);

            //Reset modal and newEvent object
            $('#addEventModal').modal('hide');
            $scope.newEvent = {
                title: '',
                start: ''
            };
        };

        $scope.editEventFromModal = function(){
            if($scope.editEvent.title === ''){
                return;
            }

            //Get old event from json
            var event = $scope.deleteEvent($scope.editEvent.start);
            if(!event){
                return;
            }

            event = event[0];

            //Add event back to json with new name and old date
            $scope.addEvent($scope.editEvent.title, event.start);

            //Reset modal and newEvent object
            $('#editEventModal').modal('hide');
            $scope.editEvent = {
                title: '',
                start: ''
            };
        };

        $scope.submit = function(){
            $scope.post.events = $scope.events;
            $http.post("/calendars/add.json?angular=true",
                $scope.post
            ).then(function(result){
                var url = $state.href('CalendarsEdit', {id: result.data.id});
                NotyService.genericSuccess({
                    message: '<u><a href="' + url + '" class="txt-color-white"> '
                        + $scope.successMessage.objectName
                        + '</a></u> ' + $scope.successMessage.message
                });

                if($scope.data.createAnother === false){
                    RedirectService.redirectWithFallback('CalendarsIndex');
                }else{
                    clearForm();
                    $scope.errors = {};
                    NotyService.scrollTop();
                }
            }, function errorCallback(result){

                NotyService.genericError();

                if(result.data.hasOwnProperty('error')){
                    $scope.errors = result.data.error;
                }
            });

        };

        //Fire on page load
        $scope.load();
        $scope.loadHolidays();

        $scope.$watch('events', function(){
            if($scope.init){
                return;
            }

            if($scope.calendar !== null){
                $scope.calendar.destroy();
            }
            renderCalendar();
        }, true);
    });
