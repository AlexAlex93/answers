<section>
    <h2>User page</h2>
    <p>Добрый день, <?= $this->data['user']->login ?>!</p>
    <section>
        <h3>User info</h3>
        <p><?= $this->data['user']->info ?></p>
    </section>
</section>