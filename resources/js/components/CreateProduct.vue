<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create Product</div>

          <div class="card-body">
            <div class="alert alert-danger" v-show="error" v-html="error"></div>
            <div class="alert alert-success" v-show="success">The product <b>{{ form.product }}</b> has been successfully created.</div>
            <form method="post" action="" @submit.prevent="create">
              <div class="form-group row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                  <input
                    id="name"
                    name="name"
                    type="text"
                    class="form-control"
                    v-model="form.name"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-4 col-form-label"
                  >Description</label
                >
                <div class="col-8">
                  <textarea
                    id="description"
                    name="description"
                    cols="40"
                    rows="5"
                    class="form-control"
                    v-model="form.description"
                  ></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="category" class="col-4 col-form-label"
                  >Category</label
                >
                <div class="col-8">
                  <select
                    id="category"
                    name="category"
                    class="custom-select"
                    multiple="multiple"
                    v-model="form.category"
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
              <div class="form-group row">
                <label for="price" class="col-4 col-form-label">Price</label>
                <div class="col-8">
                  <input
                    id="price"
                    name="price"
                    type="number"
                    class="form-control"
                    v-model="form.price"
                  />
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="submit" type="submit" class="btn btn-primary">
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  props: ['categories'],
  data: function () {
    return {
      error: '',
      success: false,
      form: {
        name: '',
        description: '',
        category: [],
        price: 0,
      },
    }
  },
  methods: {
    create() {
      axios
        .post('', this.form)
        .then((response) => {
            this.success = true
        })
        .catch((error) => {
          this.error = `Error ${error.response.status} : ${error.response.statusText}`
          const errors = error.response.data.errors
          for (const e in errors) {
            this.error += '<br>' + errors[e].join(', ',)
          }
        })
    },
  },
}
</script>
