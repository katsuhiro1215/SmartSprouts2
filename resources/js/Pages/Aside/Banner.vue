<script setup>
// Components
import Aside from '@/Components/Aside.vue';
import Button from '@/Components/Buttons/Button.vue';
import Card from '@/Components/Cards/Card.vue';
</script>

<template>
  <Aside>
    <div class="relative w-full flex flex-wrap gap-5">
      <div class="w-60">
        <Card>
          <template #content>
            <div class="space-y-2">
              <img src="upload/image.jpg" alt="">
              <h2 class="text-xl font-bold mb-3">新規登録</h2>
              <p>新規入会者はこちらからお申し込みくらだい。</p>
            </div>
          </template>
          <template #footer>
            <div class="flex justify-end">
              <Button class="w-full" buttonType="primary">詳細を見る</Button>
            </div>
          </template>
        </Card>
      </div>
      <div class="w-60">
        <Card>
          <template #content>
            test
          </template>
        </Card>
      </div>
      <div class="w-60">
        <Card>
          <template #content>
            test
          </template>
        </Card>
      </div>
      <div class="w-60">
        <Card>
          <template #content>
            test
          </template>
        </Card>
      </div>
    </div>
  </Aside>
</template>