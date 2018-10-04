<?php

declare(strict_types=1);

namespace BestIt\Sniffs;

use BestIt\CodeSniffer\File;
use BestIt\CodeSniffer\Helper\DocHelper;

/**
 * Trait DocPosProviderTrait.
 *
 * @author blange <bjoern.lange@bestit-online.de>
 * @package  BestIt\Sniffs
 */
trait DocPosProviderTrait
{
    /**
     * The position of the doc comment or null.
     *
     * @var int|null
     */
    private $docCommentPos = -1;

    /**
     * The used doc Helper.
     *
     * @var DocHelper
     */
    private $docHelper = null;

    /**
     * The used file.
     *
     * @var File|void
     */
    protected $file;

    /**
     * Position of the listened token.
     *
     * @var int|void
     */
    protected $stackPos;

    /**
     * Returns the position of the doc block if there is one.
     *
     * @return int|null
     */
    protected function getDocCommentPos(): ?int
    {
        if ($this->docCommentPos === -1) {
            $this->docCommentPos = $this->loadDocCommentPos();
        }

        return $this->docCommentPos;
    }

    /**
     * Returns the helper for the doc block.
     *
     * @return DocHelper
     */
    protected function getDocHelper(): DocHelper
    {
        if ($this->docHelper === null) {
            $this->docHelper = new DocHelper($this->getFile()->getBaseFile(), $this->getStackPos());
        }

        return $this->docHelper;
    }

    /**
     * Type safe getter for the file.
     *
     * @return File
     */
    private function getFile(): File
    {
        return $this->file;
    }

    /**
     * Type safe getter for the stack position for this sniff.
     *
     * @return int
     */
    private function getStackPos(): int
    {
        return $this->stackPos;
    }

    /**
     * Loads the position of the doc comment.
     *
     * @return int|null
     */
    protected function loadDocCommentPos(): ?int
    {
        $docHelper = $this->getDocHelper();

        return $docHelper->hasDocBlock() ? $docHelper->getBlockStartPosition() : null;
    }

    /**
     * Removes the cached data for the doc comment position.
     *
     * @return void
     */
    protected function resetDocCommentPos(): void
    {
        $this->docCommentPos = -1;
        $this->docHelper = null;
    }
}