<?php

namespace Models;

use App\Models\Clearbit;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClearbitTest extends TestCase
{
    public function testGetCompanyExpectNotFoundException()
    {
        $this->expectException(NotFoundHttpException::class);

        $clearbit = new Clearbit(env('CLEARBIT_API_KEY'));
        $body = $clearbit->getCompany('ggg.com');
    }

    public function testGetCompanyExpectBadRequestException()
    {
        $this->expectException(BadRequestException::class);

        $clearbit = new Clearbit(env('CLEARBIT_API_KEY'));
        $clearbit->getCompany('dgsdfgsdgfdsfg.com');
    }

    /**
     *
     * @dataProvider providerTestGetCompany
     */
    public function testGetCompanySuccess($domain, $expectedBody)
    {
        $clearbit = new Clearbit(env('CLEARBIT_API_KEY'));
        $body     = $clearbit->getCompany($domain);

        $this->assertSame($body, $expectedBody);
    }

    public function providerTestGetCompany(): array
    {
        return [
            ['segment.com', '{
  "id": "f3514cf8-c3c1-4eb4-be6a-13604de59c8b",
  "name": "Segment",
  "legalName": "Segment.io Inc",
  "domain": "segment.com",
  "domainAliases": [
    "segment.io"
  ],
  "site": {
    "phoneNumbers": [
      "+1 866-538-5962",
      "+1 800-952-5210"
    ],
    "emailAddresses": [
      "legal@segment.com",
      "friends@segment.com",
      "privacy@segment.com",
      "support-leads@segment.com",
      "billing@segment.com"
    ]
  },
  "category": {
    "sector": "Information Technology",
    "industryGroup": "Software & Services",
    "industry": "Internet Software & Services",
    "subIndustry": "Internet Software & Services",
    "sicCode": "73",
    "naicsCode": "54"
  },
  "tags": [
    "Technology",
    "Information Technology & Services",
    "Internet",
    "SAAS",
    "B2B"
  ],
  "description": "Segment is a customer data platform (CDP) that helps you collect, clean, and activate your customer data.",
  "foundedYear": 2012,
  "location": "100 California St #700, San Francisco, CA 94111, USA",
  "timeZone": "America/Los_Angeles",
  "utcOffset": -8,
  "geo": {
    "streetNumber": "100",
    "streetName": "California Street",
    "subPremise": "700",
    "city": "San Francisco",
    "postalCode": "94111",
    "state": "California",
    "stateCode": "CA",
    "country": "United States",
    "countryCode": "US",
    "lat": 37.7937259,
    "lng": -122.3979866
  },
  "logo": "https://logo.clearbit.com/segment.com",
  "facebook": {
    "handle": "segmentio",
    "likes": 4983
  },
  "linkedin": {
    "handle": "company/segment-io"
  },
  "twitter": {
    "handle": "segment",
    "id": "379327241",
    "bio": "We help companies put their customers first with our customer data platform. Get a demo: https://t.co/1V9U4B3DTb   Support: https://t.co/Ovb1c4DfDf",
    "followers": 24340,
    "following": 7065,
    "location": "San Francisco, CA",
    "site": "https://t.co/lJXmMreyFm",
    "avatar": "https://pbs.twimg.com/profile_images/1268236101681963008/1vw2IN5A_normal.jpg"
  },
  "crunchbase": {
    "handle": "organization/segment-io"
  },
  "emailProvider": false,
  "type": "private",
  "ticker": null,
  "identifiers": {
    "usEIN": null
  },
  "phone": null,
  "metrics": {
    "alexaUsRank": 1974,
    "alexaGlobalRank": 6163,
    "employees": 900,
    "employeesRange": "251-1K",
    "marketCap": null,
    "raised": 283700000,
    "annualRevenue": null,
    "estimatedAnnualRevenue": "$100M-$250M",
    "fiscalYearEnd": null
  },
  "indexedAt": "2021-12-24T02:50:54.380Z",
  "tech": [
    "aws_route_53",
    "optimizely",
    "nginx",
    "segment",
    "recaptcha",
    "contentful",
    "bing_advertiser",
    "mad_kudu",
    "facebook_advertiser",
    "google_analytics",
    "hotjar",
    "drift",
    "google_tag_manager",
    "talend",
    "stripe",
    "quickbooks",
    "informatica",
    "apache_tomcat",
    "atlassian_jira",
    "bluekai",
    "rubicon_project",
    "filemaker_pro",
    "appnexus",
    "teradata",
    "salesforce",
    "microsoft_project",
    "apache_kafka",
    "aws_kinesis",
    "aws_redshift",
    "hbase",
    "rabbitmq",
    "bamboohr",
    "oracle_business_intelligence",
    "netsuite",
    "aws_dynamodb",
    "github",
    "ibm_cognos",
    "zedo",
    "neo4j",
    "apache_cassandra",
    "openx",
    "apache_spark",
    "iponweb_bidswitch",
    "mongodb",
    "facebook_workplace",
    "mediamath",
    "okta",
    "dstillery",
    "aggregate_knowledge",
    "pubmatic",
    "turn",
    "sap_crystal_reports",
    "hive",
    "microstrategy",
    "apache_hadoop",
    "adobe_marketing_cloud",
    "sap_business_objects",
    "oracle_crm",
    "couchdb",
    "postgresql",
    "trello",
    "datadog",
    "unbounce",
    "mysql",
    "dropbox"
  ],
  "techCategories": [
    "dns",
    "website_optimization",
    "web_servers",
    "customer_data_platform",
    "authentication_services",
    "content_management_system",
    "advertising",
    "marketing_automation",
    "analytics",
    "live_chat",
    "tag_management",
    "data_management",
    "payment",
    "accounting_and_finance",
    "project_management_software",
    "database",
    "crm",
    "productivity",
    "data_processing",
    "human_capital_management",
    "business_management",
    "security",
    "monitoring"
  ],
  "parent": {
    "domain": null
  },
  "ultimateParent": {
    "domain": null
  }
}'],
        ];
    }
}
