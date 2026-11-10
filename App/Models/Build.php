<?php 

namespace App\Models;

use Framework\Core\Model;

class Build extends Model
{
    public const PLATFORMS = ['windows' => 'Windows', 'macos' => 'macOS', 'linux' => 'Linux'];
    protected static ?array $fillable = ['version', 'platform', 'changelog', 'downloadUrl', 'releasedAt'];

    protected ?int $id = null;
    protected ?string $version = null;
    protected ?string $platform = null;
    protected ?string $changelog = null;
    protected ?string $downloadUrl = null;
    protected ?string $releasedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }

    public function getChangelog(): ?string
    {
        return $this->changelog;
    }

    public function setChangelog(string $changelog): void
    {
        $this->changelog = $changelog;
    }

    public function getDownloadUrl(): ?string
    {
        return $this->downloadUrl;
    }

    public function setDownloadUrl(string $downloadUrl): void
    {
        $this->downloadUrl = $downloadUrl;
    }

    /**
     * @return string|null Date in the database format, e.g. "2026-11-06".
     */
    public function getReleasedAt(): ?string
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(string $releasedAt): void
    {
        $this->releasedAt = $releasedAt;
    }

    /**
     * Label of the platform for the UI, e.g. "macOS" for "macos".
     */
    public function getPlatformLabel(): string
    {
        return self::PLATFORMS[$this->platform] ?? (string)$this->platform;
    }

    /**
     * Reports of this build (1:N). Works only on a build loaded from the DB (getOne/getAll).
     *
     * @return Report[]
     */
    public function getReports(): array
    {
        return $this->getAllRelated(Report::class);
    }
}

?>