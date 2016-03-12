var App = {};

App.data = {};
App.data.initDatagrid = false;
App.data.newFilters = false;
App.data.count = 0;
App.data.selectedRows = [];
App.data.selectRow = function(data, clear) {
    if (clear) {
        App.data.selectedRows = [];
    }
    App.data.selectedRows.push(data);
};