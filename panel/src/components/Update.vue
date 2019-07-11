<template>
	<div class="modal-card" style="width: auto">
		<header class="modal-card-head">
			<p class="modal-card-title">Обновление информации</p>
		</header>
		<section class="modal-card-body">
			<b-field label="Имя">
				<b-input
					type="text"
					v-model="newName"
					placeholder="имя..."
					required>
				</b-input>
			</b-field>

			<b-field label="Телефон">
				<div class="field-body">
					<div class="field has-addons">
						<p class="control">
							<button class="button is-static">+</button>
						</p>
						<p class="control is-expanded">
							<b-input
								type="number"
								v-model="newTelephone"
								placeholder="79991112233"
								required>
							</b-input>
						</p>
					</div>
				</div>
			</b-field>

		</section>
		<footer class="modal-card-foot">
			<button class="button" type="button" @click="$parent.close()">Закрыть</button>
			<button class="button is-primary" @click="save()">Сохранить</button>
		</footer>
	</div>
</template>

<script>
import { HTTP } from './../http-common.js'

export default {
	name: 'Update',
	props: ['id','fio','tel'],
	data () {
		return {
			newName: this.name,
			newTelephone: this.telephone,
		}
	},
	methods: {
		save () {
			if (!this.name || !this.telephone) {
				return
			}
			HTTP.post('/update/'+this.id, {
				name: this.newName,
				email: this.newEmail,
				telephone: Number(this.newTelephone)
			}).then(res => {
				this.$emit('saved', res.data)
				this.$toast.open('Информация обновлена')
				this.$parent.close()
			})
		}
	}
}
</script>