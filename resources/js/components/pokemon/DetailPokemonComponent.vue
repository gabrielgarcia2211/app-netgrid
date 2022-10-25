<style>
.card-img-top {
  border: solid 0.3em aquamarine;
}
</style>

<template>
  <div class="container" style="width: 100%; padding: 20px">
    <div class="card border-0">
      <h2 class="card-title">
        {{ this.pokemonDetail.name }}
        <p style="color: blue; display: inline;">
          EXP - {{ this.pokemonDetail.base_experience }}
          <button class="btn btn-link" style="color: yellow; display: inline-block; display:flex; float:right;">
            <i class="fa fa-star fa-3x" aria-hidden="true" title="Favoritos"></i>
          </button>
        </p>
      </h2>
      <div class="row">
        <div class="col-6">
          <div class="card">
            <img
              class="card-img-top"
              style="width: 100%"
              :src="this.pokemonDetail.sprites.front"
              alt="Card image cap"
            />
          </div>
        </div>
        <div class="col-6">
          <div class="card">
            <img
              class="card-img-top"
              style="width: 100%"
              :src="this.pokemonDetail.sprites.back"
              alt="Card image cap"
            />
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <strong>Movimientos:</strong>
            <ul v-if="this.pokemonDetail.moves">
              <li v-for="item in this.pokemonDetail.moves" v-bind:key="item.id">
                {{ item }}
              </li>
            </ul>
            <p v-else>N/A</p>
          </div>
          <div class="col-3">
            <strong>Habilidades:</strong>
            <ul>
              <li
                v-for="item in this.pokemonDetail.abilities"
                v-bind:key="item.id"
              >
                {{ item }}
              </li>
            </ul>
          </div>
          <div class="col-3">
            <strong>Retenidos:</strong>
            <ul v-if="this.pokemonDetail.held_items">
              <li
                v-for="item in this.pokemonDetail.held_items"
                v-bind:key="item.id"
              >
                {{ item }}
              </li>
            </ul>
            <p v-else>N/A</p>
          </div>
          <div class="col-3">
            <strong>Tipo:</strong>
            <ul v-if="this.pokemonDetail.types">
              <li
                v-for="item in this.pokemonDetail.types"
                v-bind:key="item.id"
              >
                {{ item }}
              </li>
            </ul>
            <p v-else>N/A</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["modalName", "pokemonDetail"],
  mounted() {},
  data() {
    return {};
  },
  components: {},
  beforeMount() {
    console.log(this.pokemonDetail);
  },
  methods: {
    hide() {
      this.$modal.hide(this.modalName);
    },
  },
};
</script>