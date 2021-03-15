<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Products list</div>

          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row">
                  <label for="search" class="col-4 col-form-label"
                    >Category</label
                  >
                  <div class="col-8">
                    <select
                      id="category"
                      name="category"
                      class="form-control"
                      v-model="category"
                    >
                      <option
                        v-for="category in categories"
                        :value="category.id"
                        :key="category.id"
                      >
                        {{ category.name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-striped mt-4" id="products-table">
              <thead>
                <tr v-for="(row, j) in cols" :key="j">
                  <th
                    v-for="(col, i) in row"
                    :key="i"
                    @click="orderBy(col.field)"
                    :rowspan="col.rowspan"
                    :colspan="col.colspan"
                    :style="{ 'text-align': col.colspan ? 'center' : 'left' }"
                    :class="col.class"
                  >
                    <span v-html="col.title" />
                    <i
                      v-if="col.sort"
                      class="fa d-none d-sm-inline-block ml-1"
                      :class="{
                        'fa-sort': orderByField !== col.field,
                        'fa-sort-up':
                          orderByField === col.field && orderByDir === '',
                        'fa-sort-down':
                          orderByField === col.field && orderByDir === '-',
                      }"
                    ></i>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="!products.length && !loading">
                  <td colspan="8" class="text-center">No products found !</td>
                </tr>
                <tr
                  v-for="(product, i) in products
                    .filter(
                      (product) =>
                        !category ||
                        product.categories.filter((c) => c.id == category)
                          .length
                    )
                    .slice((page - 1) * itemsPerPage, page * itemsPerPage)"
                  :key="i"
                >
                  <td class="d-none">{{ product.id }}</td>
                  <td>
                    {{ product.name }}
                  </td>
                  <td>
                    {{ product.description }}
                  </td>
                  <td>
                    {{ product.categories.map((c) => c.name).join(', ') }}
                  </td>
                  <td>
                    {{ product.price }}
                  </td>
                </tr>
              </tbody>
              <tfoot></tfoot>
            </table>
            <div
              class="row justify-content-end justify-content-sm-between align-items-baseline m-0 my-4 custom"
            >
              <div class="term d-none d-sm-block">
                Total : {{ totalRecords }} products
              </div>
              <Paginate
                :page-count="Math.ceil(totalRecords / this.itemsPerPage)"
                :margin-pages="3"
                :click-handler="setPage"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
                :page-class="'page-item'"
                :page-link-class="'page-link'"
                :prev-link-class="'page-link'"
                :next-link-class="'page-link'"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Paginate from 'vuejs-paginate'
export default {
  props: ['products', 'categories'],
  components: {
    Paginate,
  },

  data() {
    return {
      category: null,
      currentPage: 1,
      itemsPerPage: 8,
      totalPages: 0,
      page: 1,
      orderByField: null,
      orderByDir: '-',
      cols: [
        [
          {
            title: 'ID',
            field: 'id',
            sort: true,
            class: 'd-none',
          },
          {
            title: 'Name',
            field: 'name',
            sort: true,
          },
          {
            title: 'Description',
            field: 'description',
          },
          {
            title: 'Categories',
            field: 'categories',
            sort: true,
          },
          {
            title: 'Price',
            field: 'price',
            sort: true,
            class: 'd-none d-sm-table-cell',
          },
        ],
      ],
      loading: false,
    }
  },

  computed: {
    totalRecords() {
      return this.products.filter(
        (product) =>
          !this.category ||
          product.categories.filter((category) => category.id == this.category)
            .length
      ).length
    },
  },

  methods: {
    setPage(number) {
      this.page = number
    },

    async orderBy(field) {
      console.log(field)
      this.products = this.products.sort(function (a, b) {
        console.log(a, b)
        return a[field].localeCompare(b[field])
      })
    },
  },
}
</script>
