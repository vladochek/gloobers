jQuery(document).ready(function () {
    var se = {

        doFilterRequest: function(url, urlParams, elementForReplace){
            $.get(url, function (data) {
            })
                .done(function (data) {
                    this.changeUrl(urlParams);
                    $(elementForReplace).html(data);
                });
        },

        filterData: function (ids, elementForReplace) {
            var urlParams = '';
            if(Array.isArray(ids)) {
                for (var id in ids) {
                    var value = $('#'.ids[id]).val();
                    urlParams = this.changeUrlParams(ids[id], value);
                }
            }else{
                var value = $('#'.ids).val();
                urlParams = this.changeUrlParams(ids, value);
            }
            var url = location.search.substr(0) + urlParams;

           this.doFilterRequest(url, urlParams, elementForReplace);
        },

        paginate: function(page, elementForReplace){
            var urlParams = this.changeUrlParams('page', page);
            var url = location.search.substr(0) + urlParams;
            this.doFilterRequest(url, urlParams, elementForReplace);
        },

        changeUrlParams: function (key, value) {
            var decodedParameters = decodeURIComponent(location.search.substr(1)).split('&');
            var parameters = {};
            for (var parameter in decodedParameters) {
                var paramName = decodedParameters[parameter].split('=')[0];
                var paramValue = decodedParameters[parameter].split('=')[1];
                parameters[paramName] = paramValue;
            }
            parameters[key] = value;
            var searchStrArr = [];
            for (var param in parameters) {
                searchStrArr.push(param + '=' + parameters[param]);
            }
            var searchStr = searchStrArr.join('&');
            searchStr = '?' + searchStr;
            return searchStr;
        },

        changeUrl: function (searchStr) {
            window.history.replaceState({}, "", searchStr);
        }
    };
    // se.filterData(['adults', 'children']);
});