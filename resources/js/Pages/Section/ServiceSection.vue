<script setup>
import Button from '@/Components/Buttons/Button.vue';
import Card from '@/Components/Cards/Card.vue';
import Section from '@/Components/Section.vue';
</script>

<template>
  <Section>
    <template #header>
      <h2 class="text-center">
        <div class="text-2xl z-40">サービス</div>
        <div class="text-sm text-green-300">Service</div>
      </h2>
    </template>
    <template #content>
      <div class="flex flex-col gap-5">
        <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
          <Card>
            <template #content>
              <h4>Service 1</h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam rem illum vel
                exercitationem quibusdam fugit tempore autem pariatur dolorem.
              </p>
            </template>
            <template #footer>
              <div class="flex justify-end">
                <Button class="w-full" buttonType="primary">詳細を見る</Button>
              </div>
            </template>
          </Card>
        </div>
        <div class="flex justify-center mt-10">
          <Button buttonType="primary">一覧を見る</Button>
        </div>
      </div>
    </template>
  </Section>
</template>