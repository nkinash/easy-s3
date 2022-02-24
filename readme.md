# EASY S3 PACKAGE

---------------------------------------

This package makes using s3 easier.

## Quick Examples

### Simple S3 usage

```php
<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use nka20\EasyS3\EasyS3Service;

// Instantiate an S3 service.
$s3 = new EasyS3Service(
    'key',
    'secret',
    'ru-central1'
);
```

### Upload file

```php
$key = '/storage/path/text.txt';

$s3->putObject('bucket', $key, 'Hello, Simple S3');
```

### Download file

```php
$s3->getObject('bucket', $key);
```

### Delete object

```php
$s3->deleteObject('bucket', $key);
```

## _It's easy, isn't it?_

___

**Docs**:
 * _listBuckets()_
 * _listObjects($bucket)_
 * _putObject($bucket, $key, $data)_
 * _getObject($bucket, $key): string_
 * _deleteObject($bucket, $key)_
 * _deleteObjects($bucket, $keys)_
 * _createBucket($bucket, $args)_
 * _deleteBucket($bucket, $args)_
 
_For advanced usage uou can get native S3Client_
```php
$awsS3Client = $s3->getClient();
$awsS3Client->...();
```

---
For details checkout https://github.com/aws/aws-sdk-php.
