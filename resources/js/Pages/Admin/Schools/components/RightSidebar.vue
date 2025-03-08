<script setup>
import { useForm } from '@inertiajs/vue3';

// Components
import Button from '@/Components/Buttons/Button.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
import SelectInput from '@/Components/Forms/SelectInput.vue';
//  Icon
import Close from 'vue-material-design-icons/Close.vue';
import ContentSaveAllOutline from 'vue-material-design-icons/ContentSaveAllOutline.vue';
import { Core as YubinBangoCore } from 'yubinbango-core2';
import { watch } from 'vue';

const props = defineProps({
  isVisible: Boolean,
  editData: Object,
  schools: Array,
});

const emit = defineEmits(['close', 'saved']);

const form = useForm({
  type: null,
  name: null,
  zipcode: null,
  address1: null,
  address2: null,
  address3: null,
  address4: null,
  phone_number: null,
});

watch(
  () => props.editData,
  (newVal) => {
    if (newVal) {
      form.id = newVal.id;
      form.type = newVal.type;
      form.name = newVal.name;
      form.zipcode = newVal.zipcode;
      form.address1 = newVal.address1;
      form.address2 = newVal.address2;
      form.address3 = newVal.address3;
      form.address4 = newVal.address4;
      form.phone_number = newVal.phone_number;
    } else {
      form.reset();
    }
  }
);

const closeSidebar = () => {
  emit('close');
};

const schools = [
  { id: '保育園', name: '保育園' },
  { id: '幼稚園', name: '幼稚園' },
  { id: '小学校', name: '小学校' },
  { id: '中学校', name: '中学校' },
  { id: '高校', name: '高校' },
  { id: '大学', name: '大学' },
  { id: 'その他', name: 'その他' },
];

const fetchAddress = () => {
  new YubinBangoCore(String(form.zipcode), (value) => {
    form.address1 = value.region;
    form.address2 = value.locality;
    form.address3 = value.street;
  });
};

const save = () => {
  if (form.id) {
    form.put(route('admin.school.update', form.id));
    closeSidebar();
  } else {
    form.post(route('admin.school.store'));
    closeSidebar();
  }
};
</script>

<template>
  <transition name="slide">
    <div
      v-if="isVisible"
      class="absolute right-0 top-0 w-full md:w-1/2 lg:w-1/3 h-full bg-white border-4 border-green-400 shadow-lg z-50"
    >
      <div class="p-6">
        <div class="flex justify-end">
          <Button
            buttonType="light"
            @click="closeSidebar"
            class="size-10 text-gray-500 hover:text-gray-700"
          >
            <Close />
          </Button>
        </div>
        <h2 class="text-xl font-semibold mb-4">{{ form.id ? '編集' : '新規作成' }}</h2>
        <!-- 新規作成フォームをここに追加 -->
        <form @submit.prevent="save">
          <div class="space-y-4">
            <div class="w-full">
              <InputLabel for="type" value="タイプ選択" required />
              <SelectInput v-model="form.type" :options="schools" required />
              <InputError class="mt-2" :message="form.errors.type" />
            </div>
            <div class="w-full">
              <InputLabel for="name" value="学校名" required />
              <TextInput
                type="text"
                class="mt-1 block w-full"
                id="name"
                v-model="form.name"
                required
                autofocus
                placeholder="学校名を入力してください。"
                autocomplete="name"
              />
              <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="flex items-center gap-2">
              <div class="w-1/2">
                <InputLabel for="zipcode" value="郵便番号" required />
                <TextInput
                  type="text"
                  class="mt-1 block w-full"
                  id="zipcode"
                  v-model="form.zipcode"
                  required
                  placeholder="郵便番号を入力してください。"
                  @change="fetchAddress"
                />
                <InputError class="mt-2" :message="form.errors.zipcode" />
              </div>
              <div class="w-1/2">
                <InputLabel for="zipcode" value="検索する" />
                <Button buttonType="pink">検索する</Button>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <div class="w-1/2">
                <InputLabel for="address1" value="都道府県名" required />
                <TextInput
                  type="text"
                  class="mt-1 block w-full"
                  id="address1"
                  v-model="form.address1"
                  required
                  placeholder="都道府県名を入力してください。"
                />
                <InputError class="mt-2" :message="form.errors.address1" />
              </div>
              <div class="w-1/2">
                <InputLabel for="address2" value="市区町村名" required />
                <TextInput
                  type="text"
                  class="mt-1 block w-full"
                  id="address2"
                  v-model="form.address2"
                  required
                  placeholder="市区町村名を入力してください。"
                />
                <InputError class="mt-2" :message="form.errors.address2" />
              </div>
            </div>
            <div class="w-full">
              <InputLabel for="address3" value="地域名" required />
              <TextInput
                type="text"
                class="mt-1 block w-full"
                id="address3"
                v-model="form.address3"
                required
                placeholder="地域名を入力してください。"
              />
              <InputError class="mt-2" :message="form.errors.address3" />
            </div>
            <div class="w-full">
              <InputLabel for="address4" value="それ以降の住所" required />
              <TextInput
                type="text"
                class="mt-1 block w-full"
                id="address4"
                v-model="form.address4"
                required
                placeholder="それ以降を入力してください。"
              />
              <InputError class="mt-2" :message="form.errors.address4" />
            </div>
            <div class="w-full">
              <InputLabel for="phone_number" value="電話番号" required />
              <TextInput
                type="text"
                class="mt-1 block w-full"
                id="phone_number"
                v-model="form.phone_number"
                required
                placeholder="電話番号を入力してください。"
              />
              <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>
            <div class="flex justify-end">
              <Button :disabled="form.processing" buttonActionType="submit" buttonType="primary">
                <ContentSaveAllOutline />
                {{ form.id ? '更新' : '保存' }}
              </Button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s ease;
}
.slide-enter,
.slide-leave-to {
  transform: translateX(100%);
}
</style>