<?php
/**
 * framework_patch_0313
 * @package modules.framework
 */
class framework_patch_0313 extends patch_BasePatch
{
	/**
	 * Returns true if the patch modify code that is versionned.
	 * If your patch modify code that is versionned AND database structure or content,
	 * you must split it into two different patches.
	 * @return Boolean true if the patch modify code that is versionned.
	 */
	public function isCodePatch()
	{
		return false;
	}
	
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		$computedPath = f_util_FileUtils::buildWebeditPath(".change", "autoload", ".computedChangeComponents.ser");
		$computedDeps = unserialize(f_util_FileUtils::read($computedPath));
		$computedDeps["change-lib"]["framework"] = array('version' => '3.0.3-1', 'path' => $computedDeps["LOCAL_REPOSITORY"] . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'framework-3.0.3-1');
		$computedDeps["change-lib"]["change-script"] = array('version' => '3.3', 'path' => $computedDeps["LOCAL_REPOSITORY"] . DIRECTORY_SEPARATOR . 'change-lib' . DIRECTORY_SEPARATOR . 'change-script' . DIRECTORY_SEPARATOR . 'change-script-3.3');
		f_util_FileUtils::write($computedPath, serialize($computedDeps));
		foreach (glob(f_util_FileUtils::buildWebeditPath(".change", "autoload", "*.autoloaded")) as $autoloadedPath)
		{
			f_util_FileUtils::unlink($autoloadedPath);
		}
		$libSrc = $computedDeps["LOCAL_REPOSITORY"] . DIRECTORY_SEPARATOR . "change-lib" . DIRECTORY_SEPARATOR . "change-script" . DIRECTORY_SEPARATOR . "change-script-3.3";
		$libDest = f_util_FileUtils::buildWebeditPath("libs", "change-script");
		f_util_FileUtils::symlink($libSrc, $libDest, f_util_FileUtils::OVERRIDE);
		f_util_System::execChangeCommand("update-autoload", array($libDest));
	}
	
	/**
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'framework';
	}
	
	/**
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0313';
	}
}