<script>
    window.fetchMasterData = function(url, callback, data = null) {
        $.ajax({
            url: url,
            method: "GET",
            data: data,
            success: function(res) {
                if (typeof callback === "function") {
                    callback(res);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });

    };


    window.getDataById = function(url, id, callback) {

        $.ajax({
            url: url,
            method: "GET",
            data: {
                id: id
            },
            success: function(res) {
                callback(res);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

    };


    // generate sr no

    window.generateSrNo = function() {

        $.ajax({
            url: "{{ route('school.common.generate_sr_no') }}",
            method: "GET",
            success: function(res) {
                $('input[name="sr_no"]').val(res.data);
            },

            error: function(err) {

                console.log(err);

            }
        });
    };


    // generate admission no

    window.generateAdmNo = function() {

        $.ajax({
            url: "{{ route('school.common.generate_admission_no') }}",
            method: "GET",
            success: function(res) {
                $('input[name="admission_no"]').val(res.data);
            },

            error: function(err) {
                console.log(err);
            }
        });
    };


    // generate enrollment no

    window.generateEnrollNo = function() {

        $.ajax({
            url: "{{ route('school.common.generate_enrollment_no') }}",
            method: "GET",
            success: function(res) {
                $('input[name="enroll_no"]').val(res.data);
            },
            error: function(err) {

                console.log(err);
            }
        });
    };

    function handleAjaxError(xhr) {

        let message = 'Something went wrong';

        if (xhr.status === 422 && xhr.responseJSON?.errors) {

            message = Object.values(xhr.responseJSON.errors)
                .flat()
                .join('<br>');

        } else if (xhr.responseJSON?.message) {

            message = xhr.responseJSON.message;

        } else if (xhr.responseText) {

            message = xhr.responseText;
        }

        showToast('error', message);

        console.error('AJAX Error:', xhr);
    }
</script>
