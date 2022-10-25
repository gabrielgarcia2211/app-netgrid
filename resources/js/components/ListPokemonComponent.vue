<template>
    <div class="container">
      
        <div class="input-group mb-3" style="width: 20%">
            <input
                type="text"
                class="form-control"
                id="filter-text-box"
                name="filter-text-box"
                placeholder="Buscar..."
                v-on:input="onFilterTextBoxChanged()" 
            />
        </div>
        <ag-grid-vue
            style="width: 100%; height: 400px; padding: 5px"
            class="ag-theme-alpine"
            :columnDefs="columnDefs"
            :defaultColDef="defaultColDef"
            @grid-ready="onGridReady"
            :rowData="rowData"
            :rowSelection="'single'"
            :pagination="true"
            :paginationPageSize="20"
            @cell-clicked="onCellClicked"
            :enableCellTextSelection="true"
        >
        </ag-grid-vue>

        <modal
            :click-to-close="true"
            :scrollable="true"
            :name="nameModalDetail"
            :width="600"
            :height="'auto'"
            style="margin-top: 40px"
        >
            <DetailPokemonComponent
                :pokemon-detail="pokemon"
                :modal-name="nameModalDetail"
            />
        </modal>
    </div>
</template>

<script>
// Importar Librerias o Modulos
import { AgGridVue } from "ag-grid-vue";
import DetailPokemonComponent from "./pokemon/DetailPokemonComponent";

export default {
    data() {
        return {
            defaultColDef: {
                sortable: true,
                flex: 1,
                minWidth: 100,
                resizable: true,
            },
            gridApi: null,
            columnApi: null,
            columnDefs: [],
            rowData: [],
            rowChange: {
                old: [],
            },
            pokemon: {},
            nameModalDetail: "description-pokemon-modal",
        };
    },
    components: {
        AgGridVue,
        DetailPokemonComponent,
    },
    created() {
        this.loadSites();
    },
    mounted() {},
    methods: {
        onGridReady(params) {
            this.gridApi = params.api;
            this.gridColumnApi = params.columnApi;
        },
        onFilterTextBoxChanged() {
            this.gridApi.setQuickFilter(
                document.getElementById("filter-text-box").value
            );
        },
        loadSites() {
            this.columnDefs = [
                {
                    headerName: "Nombre",
                    field: "name",
                    cellStyle: { padding: "10px" },
                },
                {
                    headerName: "Url",
                    field: "url",
                    cellStyle: { padding: "10px" },
                },
            ];
            axios
                .get("/pokemons/list")
                .then((data) => {
                    this.rowData = data.data.results ? data.data.results : [];
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        onCellClicked(event) {
            if (event.colDef.field === "name") {
                axios
                    .get(`pokemons/details/${event.data.name}`)
                    .then((data) => {
                        this.pokemon = data.data ? data.data : [];
                        this.$modal.show(this.nameModalDetail);
                    })
                    .catch((error) => {
                        this.$readStatusHttp(error);
                    });
            }
        },
    },
};
</script>
