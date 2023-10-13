import axios from "axios";

let headers = {};

const apiService = {
    POST: (url, param, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.post(url, param, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
            }
            if (error_code === 403) {
            }
        })
    },

    GET: (url, callback) => {
        axios.get(url, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
                store.dispatch('Logout');
            }
        })
    },

    UPLOAD: (url, media, callback) => {
        const MediaHeaders = {
            "Content-Type": "multipart/form-data",
        };
        axios.post(url, media, {headers: MediaHeaders}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
                console.log('Error')
            }
        })
    },


    ErrorHandler(errors) {
        console.log($('.form-group'),'form')
        $('.is-invalid').removeClass('is-invalid');
        $('.error-report').html('');
        $('.error-report-g').html('');
        $.each(errors, (i, v) => {
            if (i === 'error') {
                $('.error-report-g').html('<p class="alert alert-danger rounded-pill">' + v + '</p>')
            } else {
                $('[name=' + i + ']').addClass('is-invalid');
                $('[name=' + i + ']').closest('.form-group').find('.error-report').html(v);
            }
        });
    },

    ClearErrorHandler() {
        $('.is-invalid').removeClass('is-invalid');
        $('.error-report').html('');
    }

}



export default apiService;
