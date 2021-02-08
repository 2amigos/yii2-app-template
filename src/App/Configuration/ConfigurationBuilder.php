<?php
namespace App\Configuration;

use Da\Config\Configuration;
use Da\Config\Contracts\ConfigurationBuilderInterface;
use Da\Config\Exception\FileNotFoundException;
use Da\Config\Exception\InvalidConfigException;
use Da\Config\Support\Filesystem;
use yii\helpers\ArrayHelper;

class ConfigurationBuilder implements ConfigurationBuilderInterface
{
    /**
     * @var string the full path  of the configuration folder
     */
    protected $configPath;
    /**
     * @var string the full path of the configuration cache
     */
    protected $cacheDirectory;
    /**
     * @var boolean whether to use cache or not
     */
    protected $useCache;
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * ConfigurationBuilder constructor.
     *
     * @param Filesystem|null $filesystem
     */
    public function __construct(Filesystem $filesystem = null)
    {
        $this->filesystem = $filesystem ?: Configuration::fs();
    }

    /**
     * @inheritdoc
     *
     * @throws InvalidConfigException
     */
    public function useDirectory(string $path): ConfigurationBuilderInterface
    {
        if (!is_dir($path)) {
            throw new InvalidConfigException('Configuration folder path seems to be incorrect.');
        }
        $this->configPath = $path;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function useCache($value): ConfigurationBuilderInterface
    {
        $this->useCache = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function useCacheDirectory($path): ConfigurationBuilderInterface
    {
        if (!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path, 0755, false, true);
        }

        $this->cacheDirectory = $path;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function build(string $name): array
    {
        $cached = $this->cacheDirectory . DIRECTORY_SEPARATOR . $name . '-config.php';

        if ($this->useCache && $this->filesystem->exists($cached)) {
            return $this->filesystem->getRequiredFileValue($cached);
        }

        $config = $this->filesystem->getRequiredFileValue($this->configPath . DIRECTORY_SEPARATOR . 'app.php');
        $sections = $this->buildSections($this->configPath);

        $config = ArrayHelper::merge($config, $sections);
        $config = ArrayHelper::merge($config, $this->buildEnv($name, Configuration::env()->get('YII_ENV')));

        $this->cacheFile($cached, $config);

        return $config;
    }

    /**
     * Builds configuration file based on environment selected.
     *
     * @param string $name the environment name
     * @param string $env current environment
     *
     * @return array
     */
    protected function buildEnv($name, $env)
    {
        $config = [];
        $sections = [];
        $configPath = Configuration::app()->getEnvConfigPath() . DIRECTORY_SEPARATOR . $name;
        $path = $configPath . DIRECTORY_SEPARATOR . $env;

        if ($this->filesystem->exists($path)) {
            $envConfig = $path . DIRECTORY_SEPARATOR . 'app.php';

            if ($this->filesystem->exists($envConfig)) {
                $config = $this->filesystem->getRequiredFileValue($envConfig);
                if (!is_array($config)) {
                    $config = [];
                }
            }
            $sections = $this->buildSections($path);
        }

        /*
         * Local configuration always overrides
         */
        $local = Configuration::str()->is($env, 'local')
            ? $sections // local env? is an override
            : ArrayHelper::merge($sections, $this->buildEnv($name, 'local'));

        return ArrayHelper::merge($config, $local);
    }

    /**
     * Caches config file.
     *
     * As an advice, this method is good for "prod" environments but not when developing, I highly recommend the use of
     * .env file to add a setting whether it should be used or not.
     *
     * @param string $path
     * @param $config
     */
    protected function cacheFile($path, $config)
    {
        if ($this->useCache) {
            $varStr = str_replace('\\\\', '\\', var_export($config, true));
            $this->filesystem->put($path, "<?php\n\nreturn {$varStr};");
        }
    }

    /**
     * Builds the configuration sections.
     *
     * @param $path
     *
     * @return array
     */
    protected function buildSections($path)
    {
        $directories = $this->filesystem->directories($path);

        $sections = [];

        foreach ($directories as $directory => $path) {
            foreach ($this->filesystem->allFiles($path, '/^.*\.php/i') as $basename => $filePath) {
                $basename = pathinfo($basename, PATHINFO_FILENAME);
                $config = $this->filesystem->getRequiredFileValue($filePath);
                if (is_array($config)) {
                    $sections[$directory][$basename] = $config;
                }
            }
        }

        return $sections;
    }
}
