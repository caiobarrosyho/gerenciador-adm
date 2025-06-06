<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerar Testes</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Gerar Testes</h1>
    <form method="post">
        <div class="mb-3">
            <?php foreach ($tests as $test): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tests[]" value="<?= $test ?>" id="<?= $test ?>">
                    <label class="form-check-label" for="<?= $test ?>">
                        <?= $test ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Gerar</button>
    </form>
    <?php if (!empty($output)): ?>
        <h2 class="mt-5">Resultado</h2>
        <?php foreach ($output as $file => $code): ?>
            <h3><?= $file ?></h3>
            <pre><?= htmlspecialchars($code) ?></pre>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
