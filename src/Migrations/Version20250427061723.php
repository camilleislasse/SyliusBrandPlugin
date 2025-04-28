<?php

declare(strict_types=1);

namespace ACSEO\SyliusBrandPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250427061723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE sylius_product ADD brand_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sylius_product ADD CONSTRAINT FK_677B9B7444F5D008 FOREIGN KEY (brand_id) REFERENCES acseo_brand (id) ON DELETE SET NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_677B9B7444F5D008 ON sylius_product (brand_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE sylius_product DROP FOREIGN KEY FK_677B9B7444F5D008
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_677B9B7444F5D008 ON sylius_product
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE sylius_product DROP brand_id
        SQL);
    }
}
