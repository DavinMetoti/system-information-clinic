export class TableManager {
    constructor(options) {
        this.csrfToken = options.csrfToken || '';
        this.restApi = options.restApi || '';
        this.entity = options.entity || 'table';
        this.datatableOptions = options.datatable || {};
        this.eventHandlers = options.on || {};
        this.tableInstance = null;

        this.init();
    }

    init() {
        this.initDataTable();
        this.bindEvents();
    }

    initDataTable() {
        if (!$.fn.DataTable) {
            console.error("DataTables library is not loaded.");
            return;
        }

        const tableSelector = `#${this.entity}_table`;
        if (!$(tableSelector).is('table')) {
            console.error(`Element with selector "${tableSelector}" is not a <table>.`);
            return;
        }

        const dtOptions = this.datatableOptions;
        const ajaxData = dtOptions.ajaxData || {};

        this.tableInstance = $(tableSelector).DataTable({
            processing: dtOptions.processing || true,
            serverSide: dtOptions.serverSide || true,
            ajax: {
                url: dtOptions.api+'/datatable' || this.restApi,
                type: dtOptions.ajaxType || 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken
                },
                data: function (d) {
                    return Object.assign(d, ajaxData);
                },
                error: function (xhr, error, thrown) {
                    console.error("DataTables AJAX error:", error, thrown);
                }
            },
            columns: dtOptions.columns || [],
            dom: dtOptions.dom,
            columnDefs: dtOptions.columnDefs || [],
            order: dtOptions.order || [[0, 'asc']],
            paging: dtOptions.paging || true,
            searching: dtOptions.searching || true,
            lengthChange: dtOptions.lengthChange || true,
            pageLength: dtOptions.pageLength || 10,
        });
    }

    bindEvents() {
        const self = this;

        if (this.eventHandlers.edit) {
            $(document).on('click', `.btn-${this.entity}-edit`, function () {
                const id = $(this).data('id');

                const url = `${self.restApi}/${id}/edit`;

                window.location.href = url;
            });
        }

        if (this.eventHandlers.delete) {
            $(document).on('click', `.btn-${this.entity}-delete`, function () {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this item?')) {
                    self.delete(id).then(() => {
                        self.tableInstance.ajax.reload();
                    });
                }
            });
        }

        if (this.eventHandlers.add) {
            $(document).on('click', `.btn-${this.entity}-add, #btn-${this.entity}-add`, function () {
                self.trigger('add');
            });
        }
    }

    trigger(eventName, data) {
        if (typeof this.eventHandlers[eventName] === 'function') {
            this.eventHandlers[eventName](data);
        }
    }

    fetchById(id) {
        return $.ajax({
            url: `${this.restApi}/${id}/edit`,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken
            }
        });
    }

    delete(id) {
        return $.ajax({
            url: `${this.restApi}/${id}`,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': this.csrfToken
            },
            success: (response) => {
                this.handleSuccess(response);
                resolve(response);
            },
            error: (xhr) => {
                this.handleError(xhr);
                reject(xhr);
            }
        });
    }

    reload() {
        if (this.tableInstance) {
            this.tableInstance.ajax.reload();
        }
    }

    handleSuccess(response) {
        App.Toast.showToast({
            title: 'Success!',
            message: response.message,
            type: 'success',
            delay: 5000
        });

        $(this.formElement)[0].reset();
    }

    handleError(xhr) {
        let errorMessage = xhr.responseJSON?.message || 'An error occurred while processing your request.';

        App.Toast.showToast({
            title: 'Error!',
            message: errorMessage,
            type: 'error',
            delay: 5000
        });
    }
}
