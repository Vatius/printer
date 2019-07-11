<template>
  <div id="app">
		<section class="hero is-primary">
			<div class="hero-body">
				<div class="container">
				<h1 class="title">
					Printer CRM
				</h1>
				<h2 class="subtitle">
					test shop
				</h2>
				</div>
			</div>
		</section>
		<section class="section">
			<div class="container">
				<div class="columns is-desktop">
					<div class="column">
            <b-field>
							<b-autocomplete
								v-model="name"
								:data="data"
								placeholder="Поиск"
								field="title"
								icon="search"
								:loading="isFetching"
								@input="getAsyncData"
								@select="option => selected = option">

								<template slot-scope="props">
									<div class="search-item">
										<p>{{ props.option.name }}</p>
										<small>
											{{ props.option.tel }}
										</small>
									</div>
								</template>
							</b-autocomplete>
						</b-field>
					</div>
				</div>
			</div>
      <div class="container">
				<table class="table is-striped is-narrow is-hoverable is-fullwidth">
					<tbody>
						<tr v-for="item in list" :key="item.id">
							<td>
								<b-icon icon="user" />
							</td>
							<td>
								{{ item.fio }}
							</td>
							<td>
								{{ item.tel }}
							</td>
							<td class="contact-controls">
								<div class="field has-addons is-pulled-right">
									<p class="control">
										<a class="button" @click="update(item.id)"><b-icon icon="pencil" /></a>
									</p>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="notification has-text-centered">
					Это тестовое задание...
				</div>
      </div>
		</section>
  </div>
</template>

<script>
import {HTTP} from './http-common.js'
import debounce from 'lodash/debounce'

export default {
  name: 'app',
  data() {
    return {
      list: [],
      data: [],
      name: '',
      selected: null,
      isFetching: false,
    }
  },
  methods: {
    getAsyncData: debounce(function () {
			this.data = []
			this.isFetching = true
			HTTP.post('/search', {
				name: this.name
			})
				.then((res) => {
					if (res.data) {
						this.data = res.data
					}
					this.isFetching = false
				})
				.catch((error) => {
					this.isFetching = false
					throw error
				})
    }, 500),
    update() {
      //some here...
    }
  },
  created() {
    HTTP.get('list').then(res => {
       this.list = res.data.data
     })
  }
}
</script>
