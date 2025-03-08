<script setup>
import { computed, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import SettingSidebarLink from '@/Components/Sidebar/SettingSidebarLink.vue';
import Alert from '@/Components/Alert.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Button from '@/Components/Buttons/Button.vue';
import Card from '@/Components/Cards/Card.vue';
import Table from '@/Components/Table/Table.vue';
// Comoonents - Form
import FormGroup from '@/Components/Forms/FormGroup.vue';
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import InputError from '@/Components/Forms/InputError.vue';
import TextArea from '@/Components/Forms/TextArea.vue';
import ImageUpload from '@/Components/Forms/ImageUpload.vue';
// Icons
import Back from 'vue-material-design-icons/ArrowLeft.vue';
// Validation
import {
  validateName,
  validateDescription,
  validateVersion,
  validateFrontend,
  validateBackend,
  validateWebsiteURL,
  validateFacebookURL,
  validateTwitterURL,
  validateInstagramURL,
  validateYouTubeURL,
  validateLINEURL,
  validateOpeningDate,
  validateAllFields,
} from './_components/Validation';

const props = defineProps({
  systemSetting: Object,
});

const form = useForm({
  name: props.systemSetting.name,
  description: props.systemSetting.description,
  version: props.systemSetting.version,
  frontend: props.systemSetting.frontend,
  backend: props.systemSetting.backend,
  website: props.systemSetting.website,
  facebook: props.systemSetting.facebook,
  twitter: props.systemSetting.twitter,
  instagram: props.systemSetting.instagram,
  youtube: props.systemSetting.youtube,
  line: props.systemSetting.line,
  opening_date: props.systemSetting.opening_date,
  system_photo_path: props.systemSetting.system_photo_path,
  system_logo_path: props.systemSetting.system_logo_path,
});

// ファイルアップロード
const inputFile = ref(null);

function handleFileUpload(event) {
  const files = event.target.files;
  if (files.length) {
    const formData = new FormData();
    formData.append('system_photo_path', files[0]);
    form.system_photo_path = formData;
  }
}

// ローディング
const isLoading = ref(false);
const loadingText = ref('');

// ボタンの状態
const isFormValid = computed(() => {
  return Object.keys(form.errors).length === 0;
});

// 登録
const update = async () => {
  validateAllFields(form);

  if (Object.keys(form.errors).length === 0) {
    isLoading.value = true;
    loadingText.value = '登録中...';
    form.post(route('admin.systemSetting.update'), {
      onFinish: () => {
        isLoading.value = false;
        loadingText.value = '';
      },
    });
  }
};
</script>

<template>
  <Head title="システム設定管理" />

  <AdminDashboardLayout>
    <template #header>
      <div class="flex sm:flex-row items-center justify-between">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight">
          System Setting | 編集
        </h1>
        <Breadcrumb
          :items="[
            { name: 'Home', url: route('admin.dashboard') },
            { name: 'Show', url: route('admin.systemSetting.edit', systemSetting.id) },
          ]"
        />
      </div>
    </template>
    <FlashMessage />

    <div class="w-full flex gap-5">
      <SettingSidebarLink />
      <div class="w-[calc(100%-64px)] sm:w-[calc(100%-80px)] lg:w-[calc(100%-96px)]">
        <Card>
          <template #header>
            <div class="flex justify-between">
              <div class="flex flex-col gap-2">
                <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-300 leading-tight">
                  システム設定
                </h2>
                <p class="pl-2 text-slate-400">システム全体の詳細情報を掲載しています。</p>
              </div>
              <div class="flex justify-end items-center gap-2">
                <Button :href="route('admin.systemSetting.index')" buttonType="secondary">
                  <Back />戻る
                </Button>
              </div>
            </div>
          </template>
          <template #content>
            <div class="space-y-6">
              <form @submit.prevent="update" class="space-y-6">
                <div class="flex flex-col lg:flex-row gap-4">
                  <div class="w-full sm:w-3/6 space-y-4">
                    <FormGroup>
                      <InputLabel for="name" value="システム名" required />
                      <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        @blur="validateName(form)"
                        required
                        placeholder="システム名を入力してください。"
                        autocomplete="name"
                      />
                      <InputError class="mt-2" :message="form.errors.name" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="description" value="システム説明" required />
                      <TextArea
                        id="description"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        @blur="validatePersonalHistory(form)"
                        placeholder="システムの説明を入力してください。"
                        required
                      />
                      <InputError class="mt-2" :message="form.errors.description" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="opening_date" value="開設日" required />
                      <TextInput
                        id="opening_date"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.opening_date"
                        @blur="validateOpeningDate(form)"
                        required
                      />
                      <InputError class="mt-2" :message="form.errors.opening_date" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="version" value="バージョン" required />
                      <TextInput
                        id="version"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.version"
                        @blur="validateVersion(form)"
                        required
                        placeholder="バージョンを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.version" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="frontend" value="フロントエンド" required />
                      <TextInput
                        id="frontend"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.frontend"
                        @blur="validateFrontend(form)"
                        required
                        placeholder="フロントエンドのバージョンを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.frontend" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="backend" value="バックエンド" required />
                      <TextInput
                        id="backend"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.backend"
                        @blur="validateBackend(form)"
                        required
                        placeholder="バックエンドのバージョンを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.backend" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="website" value="Website URL" />
                      <TextInput
                        id="website"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.website"
                        @blur="validateWebsite(form)"
                        placeholder="WebサイトURLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.website" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="facebook" value="Facebook URL" />
                      <TextInput
                        id="facebook"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.facebook"
                        @blur="validateURL(form)"
                        placeholder="Facebbok URLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.website" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="twitter" value="Twitter URL" />
                      <TextInput
                        id="twitter"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.twitter"
                        @blur="validateURL(form)"
                        placeholder="Twitter URLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.twitter" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="instagram" value="Instagram URL" />
                      <TextInput
                        id="instagram"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.instagram"
                        @blur="validateURL(form)"
                        placeholder="Instagram URLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.instagram" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="youtube" value="YouTube URL" />
                      <TextInput
                        id="youtube"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.youtube"
                        @blur="validateURL(form)"
                        placeholder="YouTube URLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.youtube" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="line" value="LINE URL" />
                      <TextInput
                        id="line"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.line"
                        @blur="validateURL(form)"
                        placeholder="LINE URLを入力してください。"
                      />
                      <InputError class="mt-2" :message="form.errors.line" />
                    </FormGroup>
                  </div>
                  <div class="w-full sm:w-2/6 space-y-4">
                    <FormGroup>
                      <InputLabel for="system_photo_path" value="システム画像" />
                      <ImageUpload
                        id="system_photo_path"
                        ref="inputFile"
                        v-model="form.system_photo_path"
                        @change="handleFileUpload"
                      />
                      <InputError class="mt-2" :message="form.errors.system_photo_path" />
                    </FormGroup>
                    <FormGroup>
                      <InputLabel for="system_logo_path" value="ロゴ画像" />
                      <ImageUpload
                        id="system_logo_path"
                        ref="inputFile"
                        v-model="form.system_logo_path"
                        @change="handleFileUpload"
                      />
                      <InputError class="mt-2" :message="form.errors.system_logo_path" />
                    </FormGroup>
                  </div>
                  <div class="w-full sm:w-1/6">
                    <Button :buttonType="isFormValid ? 'warning' : 'secondary'" type="submit" :disabled="!isFormValid">更新</Button>
                  </div>
                </div>
              </form>
            </div>
          </template>
        </Card>
      </div>
    </div>
  </AdminDashboardLayout>
</template>
