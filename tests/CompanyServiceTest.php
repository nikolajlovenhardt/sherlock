<?php

namespace Ageras\CompanyData\Tests;

use Ageras\CompanyData\CompanyService;
use Ageras\CompanyData\Models\Company;

class CompanyServiceTest extends TestCase
{
    public function test_that_the_correct_company_by_vat_number_is_returned_from_the_cvr_provider()
    {
        $service = new CompanyService();

        $company = $service->companyByVatNumber('33966369', 'dk');

        $this->assertEquals(Company::class, get_class($company));
        $this->assertEquals('AGERAS A/S', $company->company_name);
    }

    public function test_that_the_correct_list_of_companies_by_name_is_returned_from_the_cvr_provider()
    {
        $service = new CompanyService();

        $companies = $service->companiesByName('Ageras', 'dk');

        $names = array_map(function(Company $company) {
            return $company->company_name;
        }, $companies);

        $this->assertContains('AGERAS A/S', $names);
    }
}
