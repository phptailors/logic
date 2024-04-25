<?php declare(strict_types=1);

$cwd = getcwd();
if (0 !== strpos($cwd, __DIR__)) {
    fwrite(STDERR, "error: invalid working directory '{$cwd}'\n");
    fwrite(STDERR, "error: the script must be invoked from a subdirectory of '".__DIR__."'\n");
    exit(1);
}

$subdir = substr($cwd, strlen(__DIR__.'/'));
$topdir = dirname(__DIR__);
$reldir = substr($cwd, strlen($topdir.'/'));

$target = $argv[1] ?? 'vendor/bin/'.$subdir;
if (!file_exists($target)) {
    fwrite(STDERR, "error: file '{$target}' does not exist\n");
    exit(1);
}

$basename = basename($target);

$bindir = __DIR__.'/../bin';
if (!file_exists($bindir)) {
    fwrite(STDOUT, "info: mkdir '{$bindir}'\n");
    mkdir($bindir, 0755);
}
$bindir = realpath($bindir);

$binfile = "{$bindir}/{$basename}";
if (file_exists($binfile)) {
    fwrite(STDERR, "warning: '{$binfile}' already exists\n");
    if (!is_link("{$binfile}")) {
        fwrite(STDOUT, "warning: '{$binfile}' is not a symlink, exiting\n");
        exit(2);
    }
    fwrite(STDERR, "warning: unlinking '{$binfile}'\n");
    unlink($binfile);
}


fwrite(STDOUT, "info: cd '{$bindir}'\n");
chdir($bindir);
fwrite(STDOUT, "info: ln -s '../{$reldir}/{$target}' '{$basename}'\n");
symlink("../{$reldir}/{$target}", $basename);
