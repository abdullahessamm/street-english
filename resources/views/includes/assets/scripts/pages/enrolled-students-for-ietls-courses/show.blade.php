<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}"></script>
<script>
$(document).ready(function(){
    function callAjax(route, data)
	{
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : route,
            type : "POST",
            data : {
				"_token" : "{{ csrf_token() }}",
				data
			},
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                });
            }
        });
	}

    $('.selectize-multiple').selectize({
        plugins: ['remove_button'],
		persist: false,
		create: true,
		render: {
			item: function(data, escape) {
				return '<div>"' + escape(data.text) + '"</div>';
			}
		},
		onDelete: function(values) {
			return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
		}
    });

    $("#openAppednStudentModalForm").on('click', function(){
        $("#appendNewStudentModal").modal('show');
    });

    /* Swtichery */
    var i = 0;
    if (Array.prototype.forEach) {

        var elems = $('.switchery');
        $.each( elems, function( key, value ) {
            var $size="", $color="",$sizeClass="", $colorCode="";
            $size = $(this).data('size');
            var $sizes ={
                'lg' : "large",
                'sm' : "small",
                'xs' : "xsmall"
            };
            if($(this).data('size')!== undefined){
                $sizeClass = "switchery switchery-"+$sizes[$size];
            }
            else{
                $sizeClass = "switchery";
            }

            $color = $(this).data('color');
            var $colors ={
                'primary' : "#967ADC",
                'success' : "#37BC9B",
                'danger' : "#DA4453",
                'warning' : "#F6BB42",
                'info' : "#3BAFDA"
            };
            if($color !== undefined){
                $colorCode = $colors[$color];
            }
            else{
                $colorCode = "#37BC9B";
            }

            var switchery = new Switchery($(this)[0], { className: $sizeClass, color: $colorCode });
        });
    } else {
        var elems1 = document.querySelectorAll('.switchery');

        for (i = 0; i < elems1.length; i++) {
            var $size = elems1[i].data('size');
            var $color = elems1[i].data('color');
            var switchery = new Switchery(elems1[i], { color: '#37BC9B' });
        }
    }
    /* End Swtichery */

    $(".suspendOrUnSuspendStudent").on('change', function(e){
        e.preventDefault();

        var student_id = $(this).data("student-id");

        var data = {
            "student_id" : student_id,
        }

        $(this).is(":checked") ? callAjax("{{ route('ajax.enrolled-students-for-ietls-courses.student.suspend') }}", data) : callAjax("{{ route('ajax.enrolled-students-for-ietls-courses.student.un-suspend') }}", data);
    }); 

    $("#appendNewStudent").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        $("#appendNewStudentModal").hide();
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.enrolled-students-for-ietls-courses.append.student') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#appendNewStudentModal").show();
                });
            },
            error: function()
            {
                $("#loading").modal('hide');
                $("#appendNewStudentModal").modal('hide');
                $("#errorModal").modal('show');
            }
        });
    });
    
    $(".removeUser").on('click', function(e){
        e.preventDefault();

        var enrolled_student_id = $(this).data("enrolled-student-id");

        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) 
                {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //Do something with upload progress here
                        $("#loading").modal({backdrop: 'static', keyboard: false});
                        
                        $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                    }
            }, false);
            return xhr;
            },
            url : "{{ route('ajax.enrolled-students-for-ietls-courses.student.remove') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "enrolled_student_id" : enrolled_student_id
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $("#tr_student_"+enrolled_student_id).remove();
                });
            }
        });
    });
});
</script>