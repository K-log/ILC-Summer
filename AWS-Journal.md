Week 1 
---
An hour long overview of the entire AWS Platform! Below are some bits of information I thought were relevant to the final exam. 

Most of the overview was information not relevant to the certification but just worth knowing for anyone working on AWS so I don't have it recorded.

Understanding the difference between a region, an Availability Zone (AZ), and an Edge Location.
 - A Region is a physical location in the world which consists of two or more Availability Zones (AZ's)
 - An AZ is one or more discrete data centers, each with redundant power, networking and connectivity, housed in separate facilities.
 - Edge Locations are endpoints for AWS which are used for caching content. Typically this consists of CloudFront, Amazon's Content Delivery Network (CDN).

SA Associate Exam Categories:
- Desktop & App Streaming               
- Application Integration
- Analytics 
- Security & Identity & Compliance
- Management Tools
- Migration
- Networking & Content Delivery
- Compute
- Storage
- Databases

Developer Associate Exam Categories:
- Application Integration
- Analytics 
- Security & Identity & Compliance
- Management Tools
- Networking & Content Delivery
- Compute
- Storage
- Databases

I completed the first quiz at the end of section two and got 18/20!

These are the questions/topics I need to review:
Which AWS compute service is specifically designed to assist you in processing large data sets?
- My Answer: Elasticache 
- Correct Answer: Elastic Map Reduce

You need a configuration management service that enables your system administrators to configure and operate your web applications using Chef. Which AWS service would best suit your needs?
- My Answer: CloudWatch
- Correct Answer: Opsworks


#### AIM(Identity Access Management):

Key terms:
  - Users - End Users/people.
  - Groups - A collection of users under one set of permissions.
  - Roles - You create roles and then assign them to AWS resources.
  - Policies - A document that defines one or more permissions. Written in JSON.

#### Lab 1: Learn how to user AIM
Step 1: Enable MFA for root account
 - Note: You can change the sign-in link for an account by clicking on customize next to the current url.
Step 2: Setup users

Step 3: Setup user groups

Step 4: Create a new policy and apply it to the created user's groups

Completed the IAM test and got 10/10!!!


Week 2 
---
### S3 - Simple Storage Service

Very import and on most exams.

S3 is a safe place to store files. Object-based storage for things like photos, videos, files. Files can be 0 - 5Tb. You pay by the GB. Files are stored in bucked which are basically folders in the cloud. Each bucket has a universal namespace or DNS. Names must be unique globally.

The format for an S3 bucket name is(Valid S3 Bucket URL): https://s3-us-west-1.amazonaws.com/mybuckername <- This can be on any of the associate or cloud practitioner tests. 

When uploading a file to S3 you will receive an HTTP 200 code if successful. 

Read after Write consistency for PUTS of new Objects. We will be able to read a file immediately after uploading a file. f we edit the file, we could get the old version of the file instead of the new one as files take some time(few milliseconds) to propagate through S3.

S3 is a simple Key-value store. 
- S3 is Object based. Object consist of the following:
  - Key(This is simply the name of the object)
  - Value(This is simply the data and is made up of a sequence of bytes)
  - Version ID(Important for versioning)
  - Metadata(Data about data you are storing)
  - Sub resources
    - Access Control List
    - Torrents

##### Features of S3
- Built for 99.99% availability.
- Amazon Guarantee 99.9% availability.
- Tiered Storage Available.
- Lifecycle Management.
- Versioning
- Encryption
- Secure your data using Access Control Lists and Bucket Policies

##### S3 tiers/Storage Classes:
- S3 Standard: 99.99% availability, 99.99999999999% (11x9) durability, stored redundantly across multiple devices in multiple facilities, and is designed to sustain the loss of 2 facilities concurrently.
  - Durable, immediately available, frequently accessed.

- S3 - IA:(Infrequently Accessed): For data that is accessed less frequently, but required rapid access when needed. Lower fee than S3, but you are charged a retrieval fee.
  - Durable, immediately available, NOT frequently accessed.

- S3 One Zone - IA: A lower-cost option for infrequently accessed data, but does not require the multiple Availability Zone data resilience.
  - Even cheaper than IA but only in one availability zone.

- Glacier: Very cheap but used for archival only. Expedited, Standard or Bulk. A Standard retrieval time takes 3 - 5 hours.
  - Archived data, where you can wait 3 - 5 hours before accessing.

##### Charges:
- Charges for S3
  - Storage - Normally per GB
  - Requests
  - Storage Management Pricing
  - Data Transfer Pricing - For transferring data to different regions
  - Transfer Acceleration - Fast and easy transfers of files between your end users and an S3 bucket. Uses Amazon CloudFront CDN and EdgeLocations for better access. 

#### Read S3 FAQ before taking the exam because it comes up A LOT!

#### Create an S3 Bucket - Lab
This lab involves creating an S3 Bucket and storing some files in it. Then playing around with the different options available to learn how S3 works. 

I created a new private S3 Bucket(You can make a Bucket public so anyone with the URL will have read/write access to all files in the Bucket).

I uploaded a simple text file and set it's access permissions to private. I also encrypted it with AES-256. I also made the file publicly available so anyone with the URL can access it. I then added some tags as the tags for the Bucket do not get passed on to the contents of the Bucket. 

S3 Buckets have a wide range of features but some of the notable ones are, Transfer Acceleration which can speed up transfers to and from a Bucket and Requester Pays, meaning that the person that requests data from the S3 Bucket must pay for the requests and data transfer fees instead of the owner of the Bucket.

You can also specify other users that have access to the Bucket through specific policies and permissions. You can specify a specific IAM user or use wildcards like * and give them access to specific parts of the Bucket.


#### Exam Tips
- Buckets are a universal name space
- Upload an object to S3 to receive a HTTP 200 Code
- S3, S3 - IA, S3 Reduced Redundancy Storage
- Encryption
  - Client Side Encryption
  - Server Side Encryption
    - Server side encryption with Amazon S3 Managed Keys(SSE-S3)
    - Server side encryption with KMS(SSE-KMS)
    - Server side encryption with Customer Provided Keys(SSSE-C) 
- Control access to Buckets using either a Bucket ACL or using Bucket Policies
- BY DEFAULT BUCKETS ARE PRIVATE AND ALL OBJECTS STORED INSIDE THEM ARE PRIVATE


#### S3 Version Control - Lab
  Basically upload a file, modify the file check out the different ways to recover or change the version of the file currently available. S3 does store each version of the file in the S3 Bucket so if it is a big file, all the different version will take up a lot of space.
  MFA delete can be used to enable MFA for the deleting of files in S3.
  When deleting a file, it gets a delete marker but is not truly deleted. These are replicated across Buckets when copied initially but are not updated if the marker is removed.

#### S3 Cross Region Replication - Lab
  Create a new S3 Bucket that stores a backup copy. The new Bucket is configured to hold a new copy of any NEW files added to the first Bucket but in order to copy any existing files over to the new bucket, this has to be done in the command line. I setup a new user(In order to access S3 from the command line I need a new key id and secret key which get assigned to each user upon creation) and used my keys to connect to my AWS resources with `aws configure`. I then copied the files from the first Bucket to the second with `aws s3 cp --recursive s3://k-log s3://k-logeutestbucket` (It is very similar to SCP) 

 ##### Cross Region Replication Exam Tips
  - Versioning must be enabled on both the source and destination buckets.
  - Regions must be unique.
  - Files in an existing bucket are not replicated automatically. All subsequent updated files will be replicated automatically.
  - You cannot replicate to multiple buckets or use daisy chaining(at this time).
  - Delete markers are replicated.
  - Deleting individual versions or delete markers will not be replicated. 
  - Understand what Cross Region Replication is at a high level.

#### Lifecycle Management & Glacier - Lab
  Setup a new S3 Bucket. Added versioning and went straight to Lifecycle management to configure it. I created a new configuration for both current and previous versions of files. Although these can have different values, I just stuck with default which was that after 30 days, current and previous versions of file would be moved to S3 Standard - IA and that after 60 days, current and previous versions of files would be moved to Glacier. After 450 days, file would be removed from storage and deleted. This is useful especially for old version control files that you don't want staying in your primary S3 bucket costing lots of money in storage costs and also don't have a high chance of being used frequently.

##### Lifecycle Management & Glacier Exam Tips
  - Can be used in conjunction with versioning.
  - Can be applied to current versions and previous versions.
  - Following actions can now be done:
    - Transition to the Standard - Infrequent Access Storage Class(30 days after the creation date by default.)
    - Archive to the Glacier Storage Class (30 days after IA, if relevant.)
    - Permanently Delete

### CloudFront
- CDN
  - A system of distributed servers or network of them that deliver web pages and other web content to a user based on the geographic location of that user as well as the origin of the web page and a content delivery server.
- Edge Location 
  - The location where content will be cached. This is separate to an AWS Region/AZ. There are over 50 edge locations in the world.
- Origin
  - The origin of all the files that the CDN will distribute. This can be either an S3 Bucket, an EC2 Instance, an Elastic Load Balancer or Route 52. This can also be your own server.
- Distribution
  - The name given to the CDN which consists of a collection of Edge Locations.

Amazon CloudFront can be used to deliver your entire website, including dynamic, static, streaming, and interactive content using a global network of edge locations. Requests for your content are automatically routed to the nearest edge location, so content is delivered with the best possible performance.

Amazon CloudFront is optimized to work with many amazon services(Specified above under Origin) and seamlessly with any non-AWS origin server which stores the original, definitive versions of your files.

##### Exam Tips
- Edge Location 
  - The location where content will be cached. This is separate to an AWS Region/AZ. There are over 50 edge locations in the world.
  - Not just READ only. You can write to them too/put an object on to them.
  - Objects are only cached for the life of the TTL(Time To Live).
  - You can clear cached object, but you will be charged.
- Origin
  - The origin of all the files that the CDN will distribute. This can be either an S3 Bucket, an EC2 Instance, an Elastic Load Balancer or Route 52. This can also be your own server.
- Distribution
  - The name given to the CDN which consists of a collection of Edge Locations.
  - Web Distribution - Typically used for Websites.
  - RTMP - Used for media streaming.


#### Create a CloudFront CDN - Lab
Upload a file to an S3 Bucket and setup CloudFront to distribute the contents of the S3 Bucket. To setup CloudFront, you setup the origin, in this case it will be an S3 Bucket. Then you select the protocols to use, the TTL(Min, Max, and Default), and restrictions on who/how people can access it by using signed URLs. You can use regular expressions to select where and what to share in CloudFront. You can use a white/blacklist to chose which countries distribute your content.

### S3 - Security & Encryption
Securing Buckets
  - By default, all newly created buckets are PRIVATE
  - You can setup access control to you bucket using:
    - Bucket Policies
    - Access Control Lists
  - S3 buckets can be configured to create access logs which log all requests made to the S3 bucket. This can be done to another bucket.

Encryption Types
  - In Transit - Sending info to and from a Bucket:
    - SSL/TLS
  - At Rest:
    - Server Side Encryption
      - S3 Managed Key - SS3-S3 
      - AWS Key Management Service, Managed Keys - SSE-KMS
      - Server Side Encryption With Customer Provided Keys - SSE-C 
    - Client Side Encryption
      - You encrypt the data BEFORE uploading it. The user is in charge of encrypting the data.

### Storage Gateway
A virtual appliance that you install on a host in your datacenter and associate with an AWS account. You use the AWS console to create a storage solution that is right for you.

##### Four Types of Storage Gateways
- File Gateway(NSF)
  - Store flat files directly on S3.
    - Pictures, Videos, Documents, etc. 
  - Once files are transferred to S3 they can be managed as native S3 objects( You can use thing like Lifecycle Policies ).
- Volume Gateway(iSCSI)
  - Block based storage using iSCSI block protocol.
  - Used for things like SQL databases or VMs
  - Data written to these volumes can be asynchronously backed up as point-in-time snapshots of your volumes, and stored in the cloud as Amazon EBS snapshots.
    - Snapshots are incremental backups that capture only changed blocks. All snapshot storage is compressed to minimize storage charges.
  - Stored Volumes
    - Store primary data locally and then asynchronously back it up to AWS. Low-latency access onsite and off-site backups. Stored in the form of EBS snapshots. 1GB to 16TB.
  - Cached Volumes
    - Use S3 for primary data storage and retain frequently accessed data locally in your storage gateway. Low-latency access to frequently accessed data and minimal need for scaling infrastructure onsite. Create storage volumes up to 32TB and attach to iSCSI devices from onsite application servers. 1GB to 32TB.
- Tape Gateway(VTL)
  - Used for archiving
  - Create virtual tapes that can be sent off to Glacier
  - Uses your existing tape-based backup application, you can create virtual tapes and store them in S3.

##### Exam Tips
- File Gateway - For flat files, stored directly on S3.
- Volume Gateway:
  - Stored Volumes - Entire Dataset is stored on site and is asynchronously backed up to S3.
  - Cached Volumes - Entire Dataset is stored on S3 and the most frequently accessed data is cached on site.
- Gateway Virtual Tape Library (VTL)
  - Used for backup and uses popular backup applications like NetBackup, Backup Exec, Veaam etc.


### Snowball
Amazon sends you a device, you load it up with your data and send it back, and then they manually upload your data to the cloud using their very fast internal network.
  - Petabyte-scale data transport solution to physically transport data to AWS.

Types of snowballs:
- Snowball
  - 80TB capacity.
  - Uses multiple layers of security. Tamper-resistant enclosures, 256-bit encryption, and an industry standard Trusted Platform Module (TPM).
  - About one-fifth the cost of using high-speed internet to transfer the data.
- Snowball Edge
  - 100TB capacity.
  - On-board computer capabilities like AWS Lambda.
  - Move large amounts of data into and out of AWS and as a temporary storage tier for large local datasets, or to support local workloads in remote or offline locations.
- Snowmobile
  - Exabyte-scale (1000 petabytes) data transfer service used to move extremely large amounts of data to AWS.
  - Transfers up to 100PB per snowmobile (a 45-foot long ruggedized shipping container pulled by a semi-truck)
  - Good for companies with massive amounts of data that is to big to realistically upload through Snowball or an internet connection.

Legacy option was Import/Export
 - Send in actual hard disks that get manually uploaded to AWS.

##### Exam Tips
- Understand what Snowball is
- Understand what Import Export is
- Snowball Can
  - Import to S3
  - Export from S3
  
### S3 Transfer Acceleration
Utilizing the CloudFront Edge Network to accelerate your uploads to S3. Instead of uploading directly to your S3 Bucket, you can use a distinct URL to upload directly to an edge location which will then transfer the files to S3. You will get a distinct URL to upload to in the form of my-S3-bucket-name.s3-accelerate.amazonaws.com.

- How to use:
  - Go to your S3 Bucket.
  - Enable Transfer Acceleration in the properties.
  - Upload files to the given URL to utilize Transfer Acceleration.

#### Creating A Static Website Using S3 - Lab
Create an S3 Bucket to host a website out of. 
- What is the URL for a static website in S3?
  - bucket-name.s3-website-us-west-1.amazonaws.com.
  - swap out `us-west-1` for whatever region your S3 bucket is in.
  - `bucketName.s3-website-regionName.amazonaws.com`

Go to properties in the S3 Bucket and enable Static Site hosting. Choose the index file for the website and then simply upload the files you want on your website. All files you want to be viewable on the website need public read access and cannot be encrypted.


#### S3 -Exam Tips for S3 101 and Summary of this week
- **Read the S3 FAQ before EXAM as it will come up a lot!**
- Remember that S3 is Object based i.e. allows you to upload files.
- Files can be from 0 Bytes to 5TB.
- RRS stands for Reduced Redundancy Storage.
- There is unlimited storage.
- Files are stored in Buckets.
- S3 is a universal namespace, that is, names must be unique globally.
- URL Pattern for S3 Buckets: `https://s3-us-west-1.amazonaws.com/mybucketname`
- Write to S3 - HTTP 200 code for successful write.
- You can load files to S3 much faster by enabling multipart uploads.
  - Breaks up files into pieces to upload and then puts them back together on S3.
- Read after Write consistency for PUTD of new Objects.
  - Can read objects immediately after they are uploaded.
- Eventual Consistency for overwrite PUTS and DELETES (can take some time to propagate).
  - If you update/delete an object on S3 it make take some time to update and you may get the older version of the object shortly after the change.
- Storage Tier/Classes
  - S3 Standard: 99.99% availability, 99.99999999999% durability, stored redundantly across multiple devices in multiple facilities and is designed to sustain the loss of 2 facilities concurrently.
  - S3 - IA: (Infrequently Accessed): For data that is accessed less frequently, but requires rapid access when needed. Lower fee than S3, but you are charged a retrieval fee.
  - S3 One Zone - IA: (RRS): Want a lower-cost option for infrequently access data, but do not require multiple Availability Zone data resilience. 
  - Glacier: Very cheap, but used for archival only. Storage types: Expedited, Standard, or Bulk. A standard retrieval time takes 3 - 5 hours. 
- Remember the core fundamentals of S3:
  - Key ( name )
  - Value ( data )
  - Version ID 
  - Metadata ( data about the data) 
  - Access Control Lists
- Object based storage only (for files).
- **Not suitable to install an operating system on.**
- Versioning
  - Stored all version of an object (including all writes and even if you delete an object)
  - Great backup tool.
  - You will be charged for EACH version of the object.
  - Once enabled, Versioning cannot be disabled, only suspended.
  - Integrates with Lifecycle rules.
  - Versioning's MFA Delete capability, which uses multi-factor authentication, can be used to provide an additional layer of security.
  - Cross Region Replication, require versioning enabled on the source bucket.
- Lifecycle Management
  - Can be used in conjunction with versioning.
  - Can be applied to current versions and previous version.
  - Following actions can now be done:
    - Transition to Standard - IA (Infrequent Access) Storage Class ( 129Kb and 30 days after the creation date ).
    - Archive to Glacier Storage Class ( 30 days after IA, if relevant )
    - Permanently Delete using Lifecycle Management rules.
- CloudFront
  - Edge Location - This this is the location where content will be cached. This is separate to an AWS Region/AZ.
  - Origin - This is the origin of all the files that the CDN will distribute. This can be either an S3 Bucket, and EC2 instance, an Elastic Load Balancer, or Route53.
  - Distribution - This is the name given the CDN which consists of a collection of Edge Locations.
    - Web Distribution - Typically used for Websites.
    - RTMP - Used for Media Streaming.
  - Edge Location are not just READ only, you can write to them too. (i.e. put an object on to them).
  - Object are cached for the life of the TTL (Time To Live). Default is 24 hours.
  - You can clear cached objects, but you will be charged. Use case would be releasing a new version of a videos and wanting that new version to be available immediately.
- Securing you buckets
  - By default, all newly created buckets are PRIVATE.
  - You can setup access control to you bucket using:
    - Bucket policies.
    - Access Control Lists.
  - S3 Buckets can be configured to create access logs which log all requests made to the S3 Bucket. The logs can be saved to another Bucket.
- Encryption
  - In Transit
    - SSL/TLS
  - At Rest
    - Server Side Encryption
      - S3 Managed Keys - SSE-S3
      - AWS Key Managed Service, Managed Keys - SSE-KMS
        - Envelope key and audit trail
      - Server Side Encryption With Customer Provided Keys - SSE-C
        - The customer provides the key for encryption and manages it.
  - Client Side Encryption
    - Encrypt the file before it is uploaded to S3.
- Storage Gateway
  - File Gateway - For flat files, stored directly on S3.
  - Volume Gateway
    - Stored Volumes - Entire dataset is stored on site and is asynchronously backed up to S3.
    - Cached Volumes - Entire dataset is stored on S3 and only the most frequently access data is cached on site.
  - Gateway Virtual Tape Library (VTL)
    - Used for backup and uses popular backup application like NetBackup, Backup Exec, Veaam etc.
    - Take virtual backups of your servers and store them in S3
- Snowball
  - Used for physically transferring large amounts of data to S3.
  - Snowball
    - 80TB of storage.
  - Snowball Edge
    - Storage + Compute capabilities. Can use AWS Lambda on them.
  - Snowmobile
    - Massive Trailer trucker to transfer Petabytes of data to S3.
- Transfer Acceleration
  - You can speed up transfers to S3 using S3 using S3 Transfer Acceleration. Costs extra, and has the greatest impact on people who are in remote or far away locations.
- Static Websites
  - You can use S3 to host static websites.
  - Server less.
  - Very cheap, scales automatically.
  - STATIC only, cannot host dynamic site (NO PHP or .NET).

Week 3 
---

### EC2 101
- Amazon Elastic Compute Cloud (Amazon EC2) is a web service that provides resizable compute capacity in the cloud. Amazon EC2 reduces the time required to obtain and boot new server instances to minutes, allowing you to quickly scale capacity, both up and down, as your computing requirements change.
- EC2 changes the economics of computing by allowing you to pay only for the capacity that you actually use. It also provides developers the tools to build failure resilient applications and isolate themselves from common failure scenarios.

##### Pricing Options And Their Use Cases
- On Demand - Allows you to pay a fixed rate by the hour (or by the second) with no commitment.
  - Perfect for users that want the low cost and flexibility of Amazon EC2 without any up-front payment or long-term commitment.
  - Applications with short term, spiky, or unpredictable workloads that cannot be interrupted.
  - Applications being developed or tested on Amazon EC2 for the first time.
- Reserved - Provides you with a capacity reservation, and offers a significant discount on the hourly charge for an instance. 1 Year or 3 Year Terms.
  - Applications with steady state or predictable usage.
  - Applications that require reserved capacity.
  - Users can make up-front payments to reduce their total computing costs even further.
    - Standard RIs (Up to 75% off on-demand)
    - Convertible RIs (Up to 54% off on-demand) feature the capability to change the attributes of the RI as long as the exchange results in the creation of Reserved Instances of equal or greater value.
    - Schedule RIs are available to launch within the time window you reserve, This option allows you to match your capacity reservation to a predictable recurring schedule that only requires a fraction of a day, a week, or a month.
- Spot - Enables you to bid whatever price you want for instance capacity, providing for even greater savings if your applications have flexible start and end times.
  - Applications that have flexible start and end times.
  - Applications that are only feasible at very low compute prices.
  - Users with an urgent need for large amounts of additional computing capacity.
- Dedicated Hosts - Physical EC2 server dedicated for your use. Dedicated Hosts can help you reduce costs by allowing you to use your existing server-bound software licenses.
  - Useful for regulatory requirements that may not support multi-tenant virtualization.
  - Great for licensing which does not support multi-tenancy or cloud deployments.
  - Can be purchased as a Reservation for up to 70% off the On-Demand price.

##### EC2 Instance Types
- How to remember them:
  - F for FPGA
  - I for IOPS
  - G - Graphics
  - H - High Disk Throughput
  - T - Cheap general purpose (think T2 Micro)
  - D for Density
  - R for RAM
  - M - Main choice for general purpose apps
  - C for Compute
  - P - Graphics (think Pics)
  - X - Extreme Memory

FIGHT DR MCPX

### EBS (Elastic Block Storage)
- What is EBS (Elastic Block Storage)? - If EC2 is a virtual server then EBS is a virtual storage disk. 
Amazon EBS allows you to create storage volumes and attach them to Amazon EC2 instances. Once attached, you can create a files system on top of these volumes, run a database, or use them in any other way you would use a block device. Amazon EBS volumes are placed in a specific Availability Zone, where they are automatically replicated to protect you from the failure of a single component.

##### EBS Volume Types 
- General Purpose SSD (GP2)
  - General purpose, balances both price and performance.
  - Ratio of 3 IOPS per GB with up to 10,000 IOPS and the ability to burst up to 3000 IOPS for extended periods of time for volumes at 3334 GiB and above.
- Provisioned IOPS SSD (IO1)
  - Designed for I/O intensive applications such as large relational or NoSQL databases.
  - Use if you need more than 10,000 IOPS.
  - Can provision up to 20,000 IOPS per volume.    
- Throughput Optimized HDD (STD1)
  - Big data
  - Data warehouses
  - Log processing
  - Cannot be a boot volume
- Cold HDD (SC1)
  - Lowest Cost Storage for infrequently accessed workloads
  - File Server
  - Cannot be a boot volume 
- Magnetic (Standard)
  - Lowest cost per gigabyte of all EBS volume types that is bootable. Magnetic volumes are ideal for workloads where data is accessed infrequently, and applications where lowest storage costs is important.

##### Exam Tips
- On Demand - Allows you to pay a fixed rate by the hour (or by the second) with no commitment.
- Reserved - Provides you with a capacity reservation, and offer a significant discount on the hourly charge for an instance. 1 Year or 3 Year Terms.
- Spot - Enables you to bid whatever price you want for instance capacity, providing for even greater savings if your applications have flexible start and end times.
- Dedicated Hosts - Physical EC2 server dedicated for your use. Dedicated Hosts can help you reduce costs by allowing you to use your existing server-bound software licenses.
- If a Spot instance is terminated by Amazon EC2, you will not be charged for a partial hour of usage. However, if you terminate the instance yourself, you will be charged for the complete hour in which the instance ran.
- Remember pneumonic: FIGHT DR MCPX
- SSD:
  - General Purpose SSD - Balances the price and performance for a wide variety of workloads.
  - Provisioned IOPS SSD - Highest-performance SSD volume for mission-critical low-latency or high-throughput workloads.
- Magnetic:
  - Throughput Optimized HDD - Low cost HDD volume designed for frequently access, throughput-intensive workloads.
  - Cold HDD - Lowest cost HDD volume designed for less frequently accessed workloads.
  - Magnetic - Previous Generation. Can be a boot volume.

#### Launch Out First EC2 Instance - Lab
Simply setup and launch an EC2 instance from the AWS Console. I have already created a lot of instances on AWS so I just skimmed this lab to see if there is anything I had not learned yet. I did learn how to setup apache and start run a simple public webserver on my EC2 instance.
- Status Checks
  - System Status Check - Makes sure the instance in reachable. If it fails there may be a problem with the infrastructure running the instance.
  - Instance Status Check - Makes sure the software and networking is working for your instance.
- Tags are only to help with identification and searchability.

##### Lab Summary
- Termination Protection is turned off by default, you MUST turn it on.
- On an EBS-backed instance, the default action is for the root EBS volume to be deleted when the instance is terminated.
- EBS Root Volumes of your DEFAULT AMI's cannot be encrypted. You can also use a third party tool (such as bit locker etc.) to encrypt the root volume, or this can be done when creating AMI's in the AWS console or using the API.
- Additional volumes CAN be encrypted.

#### Security Group Basics - Lab
- Steps
  - Create a new AWS instance.
  - Connect to the instance.
  - Update the instance.
  - Install httpd.
  - Start the httpd service.
  - Configure apache to always turn on with `chkconfig httpd`.
  - Create an index.html in `/var/www/html`.
  - Play around with the security groups to see what happens.

- Changes to security groups are instant!
- Security Groups are STATEFUL.
  - If you add an inbound rule, it automatically adds an outbound rule.
- All traffic is blocked by default and you have to allow traffic in or out.

##### Lab Summary
- All Inbound Traffic is blocked by default.
- All Outbound Traffic is allowed.
- Changes to Security Groups take effect immediately.
- You can have any number of EC2 instances within a security group.
- You can have multiple security groups attached to EC2 Instances.
- Security Groups are STATEFUL.
  - If you create an inbound rule allowing traffic in, that traffic is automatically allowed back out again.
- You cannot block specific IP addresses using Security Groups, instead use Network Access Control Lists.
- You can specify allow rules, but not deny rules.

#### EBS Volumes - Lab
 Launch an instance as before with the same security group, but configure the drives as follows:
  - Root drive - General Purpose SSD
  - Type = EBS - Magnetic
  - Type = EBS - Throughput Optimized HDD
  - Type = EBS - Cold HDD
- EBS Volumes must be in the same Availability Zone as the Instance.
- The way to tell which Volume in the volumes tab is the root volume is based on the snapshot
- It is possible to modify all volumes except common magnetic ones.
- How to move volumes from one Availability zone to another.
  - Create a snapshot of the volume.
  - Under the snapshots tab, you can create a new volume of a different type from the snapshot of the other volume.
- You can create an image from an EBS snapshot to allow you to create a new EC2 volume or instance and boot from it.
- You can also directly create a new AMI (Amazon Machine Image) from one you already have and run it.
- Only root volumes are deleted when Terminating an EC2 instance. The others need to be deleted manually.

##### Exam Tips
- Volumes exist on EBS:
  - Virtual Hard Disk.
- Snapshots exist(saved) on S3.
- Snapshots are point in time copies of Volumes.
- Snapshots are incremental - this means that only the blocks that have changed since you last snapshot are moved to S3.
- If this is your first snapshot, it may take some time to create.
- To create a snapshot for Amazon EBS volumes that serve as root devices, you should stop the instance before taking the snapshot.
- However, you can take a snap while the instance is running.
- You can create AMI's from EBS-backed Instances and Snapshots.
- You can change EBS volume sizes on the fly, including changing the size and storage type.
- Volumes will ALWAYS be in the same availability zone as the EC2 instance.
- To move an EC2 volume from one AZ/Region to another, take a snap or an image of it, then copy it to the new AZ/Region.
- Snapshots of encrypted volumes are encrypted automatically. 
- Volumes restored from encrypted snapshots are encrypted automatically.
- You can share snapshots, but only if they are unencrypted. 
  - These snapshots can be shared with other AWS accounts or made public.

### Creating a Windows EC2 instance & RAID Group

  ##### RAID, Volumes and Snapshots
  - RAID = Redundant Array of Independent Disks.
    - RAID 0 - Striped, No Redundancy, Good Performance.
    - RAID 1 - Mirrored, Redundancy.
    - RAID 5 - Good for reads, bad for writes, AWS does NOT recommend ever putting RAID 5's on EBS.
    - RAID 10 - Striped & Mirrored, Good Redundancy, Good Performance.
  - RAID 0 & RAID 1 are the most common.

  ##### Creating a windows VM
  - Create an instance like normal but use the Windows Server AMI
  - Configure the security group to allow RDP on port 3389. This is so we can remotely connect to it.
  - Add 4 more General Purpose SSD's for our RAID group.
  - Problem - Take a snapshot, the snapshot excludes the data held in the cache by applications and the OS. This tends not to matter on a single volume, however using multiple volumes in a RAID array, this can be a problem due to interdependencies of the array.
  - Solution - Take an application consistent snapshot.
    - Stop the application from writing to disk.
    - Flush all caches to the disk.
    - How can we do this?
      - Freeze the file system
      - Unmount the RAID Array
      - Shutting down the associated EC2 instance.

#### Create an AMI - Lab
- To create a snapshot for Amazon EBS volumes that serve as root devices, you should stop the instance before taking the snapshot.
- Snapshots of encrypted volumes are encrypted snapshots are encrypted automatically.
- You can share snapshots, but only if they are unencrypted. The encryption key is tied to your account.
  - These snapshots can be shared with other AWS accounts or made public.

### AMI's - EBS Root Volumes vs Instance store
- You can select your AMI based om.
  - Region (see Regions and Availability Zones)
  - Operating System
  - Architecture (32-bit or 64-bit)
  - Launch Permissions
  - Storage for the Root Device (Root Device Volume)
    - Instance Store (EPHEMERAL STORAGE)

All AMIs are categorized as either backed by Amazon EBS or backed by instance store.

For EBS Volumes: The root device for an instance launched from the AMI is an Amazon EBS volume created from an Amazon EBS snapshot.

For Instance Store Volumes: The root device for an instance launched from the AMI is an instance store volume created from a templated stored in Amazon S3.  

##### Exam Tips
- Instance Store Volumes are sometimes called Ephemeral Storage.
- Instance store volumes cannot be stopped. If the underlying host fails, you will lose your data.
- EBS backed instances can be stopped. You will not lose the data on this instance if it is stopped.
- You can reboot both without losing your data.
- By default, both ROOT volumes will be deleted on termination, however with EBS volumes, you can tell AWS to keep the root device volume.

### Load Balancers
Handle the web traffic load for your applications on EC2.
There are three types of load balancers. Application Load Balancers, Network Load Balancers, and Classic Load Balancers. 

- Application Load Balancers - Best suited for load balancing of HTTP and HTTPS traffic. They operate at Layer 7 and are application-aware. They are intelligent, and you can create advanced request routing, sending specified requests to specific web servers.

- Network Load Balancers - Best suited for load balancing of TCP traffic where extreme performance is required. Operating at the connection level (layer 4), Network Load Balancers are capable of handling millions of requests per second, while maintaining ultra-low latencies.
  - Use for extreme performance.

- Classic Load Balancers - They are legacy Elastic Load Balancers. You can load balance HTTP/HTTPS applications and use Layer 7-specific features, such as X-Forwarded and sticky sessions. You can also use strict Layer 4 load balancing for applications that rely purely on the TCP protocol.

### Load Balancer Errors
- Classic Load Balancer - If your application stops responding the ELB (Classic Load Balancer) responds with a 504 error. This means that the application is having issues. This could be either at the Web Server layer or at the Database Layer. Identify where the application is failing, and scale it up or out where possible.

- X-Forwarded-For Header - Used to pass the public IP(Which is lost when traffic passes through the load balancer) to you application so you can see who is viewing your Web Server and not just the internal load balancer IP.

##### Exam Tips
- 3 Types of Load Balancers:
  - Application Load Balancers.
  - Network Load Balancers.
  - Classic Load Balancers.
- 504 Error means the gateway has timed out. This means that the application is not responding within the idle timeout period. 
  - Troubleshoot the application. Is it the Web or Database Server?
- If you need the IPv4 address of your end user, look for the X-Forwarded-For header.
- Instances monitored by ELB are reported as:
  - InService or OutOfService.
- Health Checks check the instance health by talking to it (essentially pinging it).
- Have your own DNS name. You are never given an IP address.
- Read the ELB FAQ for Classic Load Balancers.

### CloudWatch EC2
Monitors AWS services that support CloudWatch and provides statistics on instances. Pulls every 5 minutes for free tier or every 1 minute for paid plan.

CloudWatch is only for performance/state monitoring and logging of your running services.

You can create custom CloudWatch Dashboards for specific applications to provide a custom view of the information.

By default, CloudWatch provides metrics on CPU, Disk, Network, and Status Checks for EC2 instances. The rest of the metrics are custom and require you to create them yourself.

You can setup alarms that will send you an email when a specific metric occurs such as CPU usage going above or below a certain value. 

##### What can I do with CloudWatch?
- Dashboards - Creates awesome dashboards to see what is happening with your AWS environment.
- Alarms - Allows you to set Alarms that notify you when particular thresholds are hit. 
- Events - CloudWatch Events helps you respond to state changes in your AWS resources.
- Logs - CloudWatch Logs helps you to aggregate, monitor, and store logs. This involves

#### AWS Command Line and EC2 - Lab
You can do almost everything from the AWS console on the command line. Just type `aws ` followed by the command. For example, `aws describe-instances` will list all the instances you have, in any state, on AWS.

You need IAM users with command line access, a secret key and key id, in order to use the command line. These are a big security risk so be careful with them and don't use them unless you need to.

#### Using IAM Roles with EC2 - Lab
- Set up a new IAM Role with full access to S3.
- Create a new AWS Instance.
- Apply the new IAM Role to the instance.
- Log into the instance and you should now have full command line access to `aws s3` commands without need to setup an IAM user with specific permission. 

This is more secure as it provides the permissions on a per-instance basis and not a per-user one so if someone were to get access to that instance, they could only have access to what that role provides and not get full user access to a whole user account. This also saves time in setting up users on the instance.

#### S3 CLI Regions - Lab
- Create three S3 buckets, each in separate regions.
- Create a new EC2 instance.
- Apply a FullS3Access IAM Role to the instance. IAM Roles can be attached to EC2 instances at any point in time.
- Now you can move information between the S3 buckets using the command line.

Using `aws s3 cp ` you can copy information between S3 buckets. If the buckets are in separate regions then you need to use the `--region` flag. When using S3 in the command line, it usually best to just use the `--region` flag whenever accessing S3 buckets.

#### Bash Scripting - Lab
You can provide a script to EC2 instances to run on startup.
- Create a new S3 bucket.
- Create a simple HTML file and upload it to the bucket.
- Create a new EC2 instance and provide the bash script in the `Configure Instance` section under the `Advanced` tab.
  - The bash script should install httpd, update the instance, copy the html file from S3 to the `/var/www/html/` directory in the instance and then start the http service. The full script can be seen below.
  - Bash scripts either be an uploaded file, or copy and pasted in directly. If it is already Base64 encoded then there is an option for that.
- Apply the S3 Full Access Role to the instance.

This is the full bash script. If you are not in the us-east-1 (n. Virginia) then you may need to use the `--region` flag for the S3 command.
```
#!/bin/bash
yum install httpd -y
yum update -y
aws s3 cp s3://YourBucketNameHere/index.html /var/www/html/
service httpd start
chkconfig httpd on
```

#### EC2 Instance Metadata - Lab
- SSH into an Instance.
- With root privileges run this command `curl http://169.254.169.254/latest/meta-data/`.
  - This URL is very import and should be remembered.
  - This returns a list of data that can be collected.
- Running this `curl http://169.254.169.254/latest/meta-data/public-ipv4` will return the public IP for the current EC2 instance.
- There are more options too, running `curl http://169.254.169.254/latest/user-data/` will return the bash script that was added to the instance when it was created.

#### Auto scaling 101 - Lab
- Create an EC2 instance Via the Auto Scaling group page with a `healthcheck.html` file in an S3 bucket and the associated bootstrap script to download and set it up.
- Create an Elastic Load Balancer for the instance.
- In the auto scaling group, after creating an instance, give the group a name and set the size to 3 instances and put each instance in its own subnet in the same region.
  - AWS automatically spreads the instances evenly across the AZs that you give it.
- Choose and Elastic Load Balancer for the auto scaling group and security group. Then run the health check off the Elastic Load Balancer.
- Using scaling policies, you can create alarms for resource utilization and increase/decrease the group size based on load of the instances.
  - For example: If CPU utilization is greater than 90% then add a new instance to the group and wait 5 minutes before doing this again if needed. Also if CPU utilization is less than 90% then remove an instance.
- You can setup notifications to notify you if there are specific issues with instances in the group. 
- Once this is all done, you can connect either to each instance directly via the DNS or to the Load Balancer which will just connect you to one that is open. Also if you terminate running instances that are part of the auto scaling group, it will automatically add new ones to fill for those.

### EC2 Placement Groups
- Two type of Placement Groups
  - Clustered Placement Groups
  - Spread Placement Groups

A cluster placement group is a grouping of instances within a single Availability Zone. Placement groups are recommended for applications that need low network latency, high network throughput , or both. Only certain instances can be launched in to a Clustered Placement Group.

A spread placement group is a group of instances that are each placed on distinct underlying hardware. Spread placement groups are recommended for applications that have a small number of critical instances that should be kept separate from each other.

- A clustered placement group can NOT span multiple Availability Zones.
- A spread placement group CAN span multiple Availability Zones.
- The name you specify for a placement group must be unique within your AWS account.
- Only certain type of instances can be launched in a placement group (Compute Optimized, GPU, Memory Optimized, Storage Optimized).
- AWS recommended homogenous instances within placement groups.
- You can NOT merge placement groups.
- You can NOT move an existing instance into a placement group. You can create an AMI from your existing instance, and then launch a new instance from the AMI into a placement group.

### EFS 
What is EFS? Amazon Elastic File System (Amazon EFS) is a file storage service for Amazon Elastic Compute Cloud (Amazon EC2) Instances. Amazon EFS is easy to use and provides a simple interface that allows you to create and configure file systems quickly and easily. With Amazon EFS, storage capacity is elastic, growing and shrinking automatically as you add and remove files, so your applications have the storage they need, when they need it.

- Features
  - Block based storage.
  - Supports the Network File System version 4 (NFSv4) protocol.
  - You only pay for the storage you use (no pre-provisioning required).
    - About 30 cents per gigabyte.
  - Can scale up to the petabytes.
  - Can support thousands of concurrent NFS connections.
  - Data is stored across multiple AZ's within a region. 
  - Read after write consistency.
  - You can apply user and/or directory level permissions for everything.
  - Unlike EBS, EFS can be used on multiple EC2 instances at the same time.

  #### EFS - Lab
  - Create two EC2 instances before WITHOUT the startup script but setup apache httpd.
  - Create and Elastic Load Balancer for them.
  - Make an EFS volume and make sure that all the instances are also in the same security group.
  - Go to EFS and mount the file system in both of the instances in the `/var/www/html` directory.
    - This will involve changing the given command in EFS.
  - Now if you put a file in the `/var/www/html` directory, it will be shared in the other instances same directory because it is a shared file system.
    - Essentially two servers serving up the same web page.

### Lambda
What is Lambda?
AWS Lambda is a compute service where you can upload your code and create a Lambda function. AWS Lambda takes care of provisioning and managing the servers that you use to run the code. You don't have to worry about operating systems, patching, scaling, etc. You can use Lambda in the following ways.
- As an event-driven compute service where AWS Lambda runs your code in response to events. These events could be changes to data in an Amazon S3 bucket or an Amazon DynamoDB table.
- As a compute service to run your code in response to HTTP requests use Amazon API Gateway or API calls made using AWS SDKs.

- Where Lambda is in the hierarchy of cloud computing.
  - Data Centers
  - Hardware
  - Assembly Code/Products
  - High Level Languages
  - Operating Systems
  - Application Layer/AWS APIs
  - AWS Lambda

- What are the triggers for AWS Lambda functions? 
  - API Gateway (Will be on the test)
  - AWS IoT
  - Alexa Skills Kit
  - Alexa Smart Home
  - CloudFront (Will be on the test)
  - CloudWatch (Will be on the test)
  - CloudWatch Events (Will be on the test)
  - CloudWatch Logs (Will be on the test)
  - CodeCommit
  - Cognito Sync Trigger
  - DynamoDB (Will be on the test)
  - Kinesis (Will be on the test)
  - S3 (Will be on the test)
  - SNS (Will be on the test)

How is Lambda priced?
- Based on the number of requests
  - First 1 million requests are free. $0.20 per 1 million requests thereafter.
- Duration  
  - Duration is calculated from the time your code begins executing until it returns or otherwise terminates, rounded up to the nearest 100ms. The price depends on the amount of memory you allocate to your function. You are charged $0.00001667 for every GB-second used.
  - Maximum function duration of 5 minutes.

Why is Lambda cool?
  - No Servers!!!
  - Continuous Scaling.
  - Super super super cheap!

A practical use case for AWS Lambda is Amazon Alexa. Every time you are using an Alexa skill it is invoking a Lambda function that then responds to you.

##### Exam Tips
- Lambda scales out (not up) automatically.
- Lambda function are independent, 1 event = 1 function.
- Lambda is server less.
- Know what services are server less!!!
- Lambda functions can trigger other Lambda functions, 1 event can = x functions if functions trigger other functions.
- Architectures can get extremely complicated, AWS X-ray allows you to debug what is happening.
- Lambda can do things globally, you can use it to back up S3 buckets to other S3 buckets etc.
- Known your triggers.


### Build a Server less Webpage
- Create an S3 bucket with the same name as your domain name.
  - Enable server less website hosting on the bucket permissions.
- Register a domain name with Route 53.
- Create a new Lambda function.
  - Python 3.6 Runtime.
  - Simple Microservice permissions Role.
- Add the code you want to the Lambda function.
  - In this case I am using the code given in the lecture.
  ```
  def lambda_handler(event, context):
    print("In lambda handler")

    resp = {
      "statusCode": 200,
      "headers": {
        "Access-Control-Allow-Origin": "*",
      },
      "body": "Noah Burwell"
    } 

    return resp
  ```
- Add the API Gateway trigger to the Lambda function.
  - Triggers are very important on the test so I should memorize all of them.
- Create a new API and configure it with a name and open access (I will delete it after I'm done so this is not too much of an issue) meaning that anyone can invoke the API call.
- Click on the new API and delete the any method and replace it with a GET method to an AWS Lambda function with our created API.
- Deploy the API into production
- Now visiting the link in the S3 bucket should trigger it and work as intended.

#### Using Polly to help pass you exam - A serverless approach - Lab
- Change Regions to `N. Virginia`.
- Go to DynamoDB and create a new table name `posts` with a primary id of `id`.
- Go to S3 and create bucket if you don't already have one and enable `Static Website Hosting`.
- Create another S3 bucket (This will be used to store the MP3 files).
- Add the following policy to the bucket to allow anything we put in there to be public.
  ```
  {
    "Version": "2012-10-17",
    "Statement": [
      {
        "Sid": "PublicReadGetObject",
        "Effect": "Allow",
        "Principal": "*",
        "Action": [
          "s3:GetObject"
        ],
        "Resource": [
          "arn:aws:s3:::pollybucket-k-log/*"
        ]
      }
    ]
  }
  ```
- Go to IAM and create a new role and select `lambda` as the service that is going to use the role. 
- Create a custom policy for the role

  ```
  {
    "Version": "2012-10-17",
    "Statement": [
        {
            "Effect": "Allow",
            "Action": [
                  "polly:SynthesizeSpeech",
                  "dynamodb:Query",
                  "dynamodb:Scan",
                  "dynamodb:PutItem",
                  "dynamodb:UpdateItem",
                  "sns:Publish",
                  "s3:PutObject",
                  "s3:PutObjectAcl",
                  "s3:GetBucketLocation",
                  "logs:CreateLogGroup",
                  "logs:CreateLogStream",
                  "logs:PutLogEvents"
            ],
            "Resource": [
                "*"
            ]
        }
    ]
  }
  ```

- Name the policy `myLambdaPollyPolicy` and put the same for the description. 
- Now go back to create a new role and actually create the role.
  - Choose lambda as the service and the new policy, `myLambdaPollyPolicy` as the policy. 
- Title the role `myLambdaPollyRole`.
- Go to SNS (Simple Notification Services) and create a new topic titled `new_posts` and display name `SNSpolly`.
- Go to Lambda (Always under the Compute tab in AWS) and create a new function titled `PostReader_NewPosts`, Runtime is `Python 2.7`, and the Role is the `myLambdaPollyRole` under existing roles.
- Replace the Lambda code and replace it with the following.
  ```
  import boto3
  import os
  import uuid

  def lambda_handler(event, context):
      
      recordId = str(uuid.uuid4())
      voice = event["voice"]
      text = event["text"]

      print('Generating new DynamoDB record, with ID: ' + recordId)
      print('Input Text: ' + text)
      print('Selected voice: ' + voice)
      
      #Creating new record in DynamoDB table
      dynamodb = boto3.resource('dynamodb')
      table = dynamodb.Table(os.environ['DB_TABLE_NAME'])
      table.put_item(
          Item={
              'id' : recordId,
              'text' : text,
              'voice' : voice,
              'status' : 'PROCESSING'
          }
      )
      
      #Sending notification about new post to SNS
      client = boto3.client('sns')
      client.publish(
          TopicArn = os.environ['SNS_TOPIC'],
          Message = recordId
      )
      
      return recordId
  ```
- Then pass the following environment variables to the function. `DB_TABLE_NAME` : `posts` and `SNS_TOPIC` : `arn:aws:sns:us-east-1:823465351466:new_posts`.
- Lastly, under Basic settings enter `This function inserts data into DynamoDB` in the description box.
- Save the function and create a test using the default Hello World template and name it `Hello Joana` and put in the following JSON.
  ``` 
  {
    "voice" : "Joanna",
    "text" : "Hello Cloud Gurus!"
  }
  ```
- Now if we go into `DynamoDB -> Tables -> Items`, we can see the test item in the table!
- Create a new Lambda function named `PostReader_ConvertToAudio` with `python 2.7` as the Runtime and `myLambdaPollyRole` as the Role.
- Add the following code to the function along with the Environment Variables `DB_TABLE_NAME` : `posts` and `BUCKET_NAME` : `mp3storagebucket-k-log`.
  ```
  import boto3
  import os
  from contextlib import closing
  from boto3.dynamodb.conditions import Key, Attr

  def lambda_handler(event, context):

      postId = event["Records"][0]["Sns"]["Message"]
      
      print "Text to Speech function. Post ID in DynamoDB: " + postId
      
      #Retrieving information about the post from DynamoDB table
      dynamodb = boto3.resource('dynamodb')
      table = dynamodb.Table(os.environ['DB_TABLE_NAME'])
      postItem = table.query(
          KeyConditionExpression=Key('id').eq(postId)
      )
      

      text = postItem["Items"][0]["text"]
      voice = postItem["Items"][0]["voice"] 
      
      rest = text
      
      #Because single invocation of the polly synthesize_speech api can 
      # transform text with about 1,500 characters, we are dividing the 
      # post into blocks of approximately 1,000 characters.
      textBlocks = []
      while (len(rest) > 1100):
          begin = 0
          end = rest.find(".", 1000)

          if (end == -1):
              end = rest.find(" ", 1000)
              
          textBlock = rest[begin:end]
          rest = rest[end:]
          textBlocks.append(textBlock)
      textBlocks.append(rest)            

      #For each block, invoke Polly API, which will transform text into audio
      polly = boto3.client('polly')
      for textBlock in textBlocks: 
          response = polly.synthesize_speech(
              OutputFormat='mp3',
              Text = textBlock,
              VoiceId = voice
          )
          
          #Save the audio stream returned by Amazon Polly on Lambda's temp 
          # directory. If there are multiple text blocks, the audio stream
          # will be combined into a single file.
          if "AudioStream" in response:
              with closing(response["AudioStream"]) as stream:
                  output = os.path.join("/tmp/", postId)
                  with open(output, "a") as file:
                      file.write(stream.read())



      s3 = boto3.client('s3')
      s3.upload_file('/tmp/' + postId, 
        os.environ['BUCKET_NAME'], 
        postId + ".mp3")
      s3.put_object_acl(ACL='public-read', 
        Bucket=os.environ['BUCKET_NAME'], 
        Key= postId + ".mp3")

      location = s3.get_bucket_location(Bucket=os.environ['BUCKET_NAME'])
      region = location['LocationConstraint']
      
      if region is None:
          url_begining = "https://s3.amazonaws.com/"
      else:
          url_begining = "https://s3-" + str(region) + ".amazonaws.com/" \
      
      url = url_begining \
              + str(os.environ['BUCKET_NAME']) \
              + "/" \
              + str(postId) \
              + ".mp3"

      #Updating the item in DynamoDB
      response = table.update_item(
          Key={'id':postId},
            UpdateExpression=
              "SET #statusAtt = :statusValue, #urlAtt = :urlValue",                   
            ExpressionAttributeValues=
              {':statusValue': 'UPDATED', ':urlValue': url},
          ExpressionAttributeNames=
            {'#statusAtt': 'status', '#urlAtt': 'url'},
      )
          
      return

  ```
- The description of the function should be something like `This function generates our mp3s and stores them in S3`.
- Set the Timeout to 5 minutes.
- Add and SNS trigger for `new_posts` and click enter.
- Now create one last Lambda function named `PostReader_GetPosts` with `python 2.7` as the Runtime and `myLambdaPollyRole` as the Role.
- Add the following code to the function along with the Environment Variables `DB_TABLE_NAME` : `posts`.
 ```
  import boto3
  import os
  from boto3.dynamodb.conditions import Key, Attr

  def lambda_handler(event, context):
      
      postId = event["postId"]
      
      dynamodb = boto3.resource('dynamodb')
      table = dynamodb.Table(os.environ['DB_TABLE_NAME'])
      
      if postId=="*":
          items = table.scan()
      else:
          items = table.query(
              KeyConditionExpression=Key('id').eq(postId)
          )
      
      return items["Items"]
 ```
 - Lastly, create a test using the Hello World Template. Title the event name `GetPosts` and add just one key value pair, `"postId": "*"`
  - This should return the data in the database if successful. 
- Now go to Amazon API Gateway and create a new API named `PostReaderAPI` with a description `My API for Polly` and a `regional` endpoint type.
  - It is important to remember that it is possible to Import API from Swagger.
- Add a new `GET` Method and choose the Lambda function `PostReader_GetPosts`.
- Add a new `POST` Method and choose the Lambda function `PostReader_NewPosts`.
- Enable CORS (Cross Origin Resource Sharing) to allow all of our systems to talk to each other. It will add and OPTIONS to our resources list.
- For the `GET` request, add a new URL Query String Parameter `postId`.
- Then under the `GET` again go to `Integration Request -> Mapping Templates` and select `When there are no templates defined (recommended)`.
  - Add a mapping template `application/json`.
  - Put the following in the mappings template and save it.
    ```
    {
      "postId" : "$input.params('postId')"
    }
    ```
- Now just select the `/` and choose `deploy api` from Actions and create a new stage and enter `prod` for all three of the values.
- Copy the invoke URL to the following JavaScript program and 
  ```
  var API_ENDPOINT = "YOUR-API-INVOKE_URL"

  document.getElementById("sayButton").onclick = function(){

    var inputData = {
      "voice": $('#voiceSelected option:selected').val(),
      "text" : $('#postText').val()
    };

    $.ajax({
          url: API_ENDPOINT,
          type: 'POST',
          data:  JSON.stringify(inputData)  ,
          contentType: 'application/json; charset=utf-8',
          success: function (response) {
            document.getElementById("postIDreturned").textContent="Post ID: " + response;
          },
          error: function () {
              alert("error");
          }
      });
  }


  document.getElementById("searchButton").onclick = function(){

    var postId = $('#postId').val();


    $.ajax({
          url: API_ENDPOINT + '?postId='+postId,
          type: 'GET',
          success: function (response) {

            $('#posts tr').slice(1).remove();

            jQuery.each(response, function(i,data) {

              var player = "<audio controls><source src='" + data['url'] + "' type='audio/mpeg'></audio>"

              if (typeof data['url'] === "undefined") {
                var player = ""
              }

              $("#posts").append("<tr> \
                  <td>" + data['id'] + "</td> \
                  <td>" + data['voice'] + "</td> \
                  <td>" + data['text'] + "</td> \
                  <td>" + data['status'] + "</td> \
                  <td>" + player + "</td> \
                  </tr>");
            });
          },
          error: function () {
              alert("error");
          }
      });
  }

  document.getElementById("postText").onkeyup = function(){
    var length = $(postText).val().length;
    document.getElementById("charCounter").textContent="Characters: " + length;
  }

  ```
- Now go to the `pollybucket-k-log` S3 bucket and upload the `script.js`(The JavaScript shown above), `index.html`, and `style.css` file.
- Now go to the URL and and enter text to be translated and then search through text in the database to play converted text.

#### Exam Tips and Summary of EC2
- Know the difference between:
  - On Demand
    - Pay by usage/time.
  - Spot
    - Pay by amount you bid.
  - Reserved
    - Pay for reserved capacity (6 - 12 months)
  - Dedicated Hosts
    - Good for if you have a lot of licensed software you want to use.
- Remember with spot instances:
  - If you terminate the instance, you pay for the hour.
  - If AWS terminates the spot instance, you get the hour it was terminated in for free.
- Remember all instance types (only the letter, not the numbers they only stand for the version)
  - FIGHT DR MCPX
  - F - FPGA
  - I - IOPS (input/output operations per second)
  - G - Graphics
  - H - High Disk Throughput
  - T - Cheap general purpose (think T2 Micro)
  - D - Density
  - R - RAM
  - M - Main choice for general purpose apps
  - C - Compute
  - P - Graphics (Think Pics)
  - X - Extreme Memory
- EBS Consists of:
  - SSD, General Purpose - GP2 - (Up to 10,000 IOPS).
  - SSD, Provisioned IOPS - IO1 - (More than 10,000 IOPS).
  - HDD, Throughput Optimized - ST1 - frequently accessed workloads.
  - HDD, Cold - SC1 - less frequently accessed data.
  - HDD, Magnetic - Standard - cheap, infrequently accessed storage.
- Magnet HDD is the only HDD that can be used as a boot drive.
- You cannot mount 1 EBS volume to multiple EC2 instances instead, use EFS.
- Termination Protection is turned off by default, you must turn it on.
- On an EBS-backed instance the default action is for the root EBS volume to be deleted when the instance is terminated.
- EBS-backed Root volumes can now be encrypted using AWS API or console, or you can use a third party tool (such as bit locker etc) to encrypt the root volume.
- Additional volumes can be encrypted.
- Volumes exist on EBS:
  - Virtual Hard Disk
- Snapshots exist on S3.
- You can take a snapshot of a volume, this will store that volume on S3.
- Snapshots are point in time copies of Volumes.
- Snapshots are incremental. This means that only the blocks that have changed since your last snapshot are moved to S3. 
- If this is your first snapshot it may take some time to create, depending on the size of the volume.
- Snapshots of encrypted volumes are encrypted automatically.
- Volumes restored from encrypted snapshots are encrypted automatically.
- You can share snapshots, but only if they are unencrypted.
  - These snapshots can be shared with other AWS accounts or made public.
- To create a snapshot for Amazon EBS volumes that serve as root devices, you should stop the instance before taking the snapshot.
- Instance Store Volumes are sometimes called Ephemeral Storage.
- Instance Store Volumes cannot be stopped. If the underlying host fails, you will lose your data.
- EBS backed instances can be stopped. You will not lose the data on this instance if it is stopped.
- You can reboot both, you will not lose your data.
- By default, both types of ROOT volumes will be deleted on termination. However, with EBS volumes, you can tell AWS to keep the root device volume.
- How can you take a Snapshot of a RAID Array?
  - Problem - Take a snapshot, the snapshot excludes data held in the cache by applications and the OS. This tends not to matter on a single volume. However, using multiple volumes in a RAID array, this can be a problem due to interdependencies of the array. 
  - Solution - Take an application consistent snapshot.
    - Stop the application form writing to disk.
    - Flush all caches to the disk.
    - How can we do this?
      - Freeze the file system.
      - Unmount the RAID Array.
      - Shutting down the associated EC2 instance.
- AMIs are regional. You can only launch an AMI from the region in which it is stored. However, you can copy AMIs to other regions using the console, command line, or the Amazon EC2 API.
- Standard Monitoring = 5 Minutes.
- Detailed Monitoring = 1 Minutes. More expensive.
- CloudWatch is for performance monitoring.
- CloudTrail is for auditing.
- What can you do with CloudWatch?
  - Dashboards - CloudWatch creates awesome dashboards to see what is happening with your AWS environment.
  - Alarms - Allows you to set Alarms that notify you when particular thresholds are hit.
  - Events - CloudWatch Events helps you to respond to state changes in your AWS resources.
  - Logs - CloudWatch Logs helps you aggregate, monitor, and store logs.
- Roles are more secure than storing your access key and secret access key on individual EC2 instances.
- Roles are easier to manage.
- Roles can be assigned to an EC2 instance AFTER it have been provisioned using both the command line and the AWS console.  
- Roles are universal - you can use them in any region.
- Instance Meta-data is used to get information about an instance (such as public ip)
  - `curl http://169.254.169.254/latest/meta-data/`
  - `curl http://169.254.169.254/latest/user-data/`
- EFS Features:
  - Supports the Network File System version 4 (NFSv4) protocol.
  - You only pay for the storage you use (no pre-provisioning required.)
  - Can scale up to the petabytes.  
  - Can support thousands of concurrent NFS connections.
  - Data is stored across multiple AZs within a region.
  - Read After Write Consistency.
- AWS Lambda is a compute service where you can upload your code and create a Lambda function. AWS Lambda takes care of provisioning and managing the servers that you use to run the code. You don't have to worry about operating systems, patching, scaling, etc. You can use Lambda in the following ways:
  - As an event-driven compute service where AWS Lambda runs your code in response to events. These events could be changes to data in an Amazon S3 bucket or an Amazon DynamoDB table.
  - As a compute service to run your code in response to HTTP requests using Amazon API Gateway or API calls made using AWS SDKs.
- Two types of placement groups:
  - Clustered Placement Groups
    - In one AZ and used for Big Data, or Low Latency and High Throughput.
  - Spread Placement Groups
    - Used for really important data you want spread among different physical hardware. 

Week 4 
---

### DNS
What is DNS?
- DNS is used to convert friendly domain names into an Internet Protocol (IP) address.
- IP addresses are used by computers to identify each other on the network. IP addresses commonly come in 2 different forms, IPv4 and IPv6.

- IPv4 space is a 32 bit field and has over 4 billion addresses
- IPv6 space is a 128 bit field and have over 240 undecillion addresses.
- The last word in a domain name is the top level domain (.com) and the second word is the second level domain name (.com.de).

The SOA record stores information about:
- The name of the server that supplied the data for the zone.
- The administrator of the zone.
- The current version of the data file.
- The number of seconds a secondary name server should wait before checking for updates or retrying a failed zone transfer.
- The maximum number of seconds that a secondary name server can use data before it must either be refreshed or expire.
- The default number of seconds for the time-to-live file on resource records. 

NS Records
- NS stands for Name Server records and are used by Top Level Domain servers to direct traffic to the Content DNS server which contains the authoritative DNS records.

A Records
- An "A" record is the fundamental type of DNS record and the "A" in A record stands for "Address". The A record is used by a computer to translate the name of the domain to the IP address. For example https://example.com could point to 129.13.12.168.

TTL
- The length that a DNS record is cached on either the Resolving Server or the users own local PC is equal to the value of the "Time To Live" (TTL) in seconds. The lower the time to live, the faster changes to DNS records take to propagate throughout the internet.

CNAMEs
- A Canonical Name (CNAME) can be used to resolve one domain name to another. For example, you may have a mobile website with the domain name http://m.example.com that is used for when users browse your main name on their mobile devices. You may also want the name http://mobile.example.com to resolve to this same address.

Alias Records
- Alias records are used to map resource records sets in your hosted zone to Elastic Load Balancers, CloudFront distributions, or S3 buckets that are configured as websites.
- Alias records work like CNAME record in that you can map one DNS name (www.example.com) to another 'target' DNS name (example1234.elb.amazonaws.com).
- Key difference - A CNAME can't be used for naked domain names (zone apex record.) You can't have a CNAME for http://example.com, it must be either an A record or an Alias.
- Alias resource records sets can save you time because Amazon Route 53 automatically recognizes changes in the record sets that the alias resource record set refers to.
- For example, suppose an alias resource record set for example.com point to an ELB load balancer at lb1-1234.us-east-1.elb.amazonaws.com. If the IP address of the load balancer changes, Amazon Rout 53 will automatically reflect those changes in DNS answers for example.com without any changes to the hosted zone that contains resource record sets for example.com.

#### Exam Tips
- ELB's do not have pre-defined IPv4 addresses, you resolve to them using a DNS name.
- Understand the difference between an Alias Record and a CNAME.
- Given the choice, always choose an Alias Record over a CNAME.

#### Route 53 - Register a Domain Name - Lab
- Go to Route 53
- Search for a Domain Name with your chosen extension.
- Fill out the form and buy the domain keeping in mind monthly usage costs.

#### Setup ECS instances - Lab
- Choose the region that is closest to you.
- Create 2 EC2 instances with a bootstrap startup script that install apache, starts the web server and creates a webpage with some simple html with something to distinguish between the instance.
- Assign a security group that has http, https, and ssh traffic allowed.
- Create a Load Balancer with the same security group as the EC2 instances.
- Configure a Health Check with low values.
- Test the EC2 instances and ELB by going to the IPs and ELB addresses with a web browser.
  - The IPs should show the HTML webpage and the ELB should alternate between the two.
- Change regions to which ever one is farthest from you.
- Create an EC2 instance with a bootstrap startup script that install apache, starts the web server and creates a webpage with some simple html with something to distinguish between the other instances. 
- Assign a security group that has http, https, and ssh traffic allowed.
- Create a Load Balancer with the same security group as the EC2 instances.
- Configure a Health Check with low values.

### Route53 Routing Policies

#### Simple Routing:

This is the default routing policy when you create a new record set. This is most commonly used when you have a single resources that performs a given function for your domain, for example, one web server that serves content for the http://example.com website.

#### Creating a Simple Routing Policy - Lab
- Go to Route53 (This is a global service so it doesn't matter which region you're in.)
- Go to the hosted zone where you registered your domain name.
- Create a new record.
  - Leave name blank.
    - You can put in things like www. mail. info. etc. under the name slot.
  - Check the yes box under Alias
  - Make the Alias target your ELB for your EC2 instances.
  - Choose the `simple` routing policy
- Click create
Now every time someone goes to that DNS, they will go to your ELB and then the ELB will route them to your EC2 instances.

#### Weighted Routing:

Weighted Routing Policies let you split your traffic based on different weights assigned. For example you can set 10% of your traffic to go to US-EAST-1 and 90% to go to EU-WEST-1.

#### Creating a Weighted Routing Policy - Lab
- Go to Route53 (This is a global service so it doesn't matter which region you're in.)
- Go to the hosted zone where you registered your domain name.
- Create a new record.
  - Leave name blank.
    - You can put in things like www. mail. info. etc. under the name slot.
  - Check the yes box under Alias
  - Make the Alias target your ELB for your EC2 instances.
  - Choose the `weighted` routing policy.
  - Under weight put down the weight for the amount of traffic you wan to go to the specified ELB.
    - Percentage is based on the total weight for each weighted policy you have made for that DNS. For example, if I put 70 in one and 30 in the other then the total is 100 so 70% will go one way and 30% will go the other but you can use what ever values you want from 0 - 255.
  - Give it a name.
- Click create
Now every time someone goes to that DNS, they will go to your first ELB  70% of the time and your second ELB 30% of the time.

#### Latency Routing:

Latency based routing allows you to route traffic based on the lowest network latency for your end user (ie which region will give them fastest response time).

To use latency-based routing you create a latency resource record set for the Amazon EC2 (or ELB) resource in each region that hosts your website. When Amazon Route 53 receives a query for you site, it selects the latency resource record set for the region that gives the user the lowest latency. Route 53 then responds with the value associated with that record set.


#### Failover Routing:

Failover routing policies are used when you want to create an active/passive set up. For example, you may want your primary site to be in EU-WEST-2 and your secondary DR Site in AP-SOUTHEAST-2/

Route53 will monitor the health of your primary site using a health check.

A health check monitors the health of your end points.


#### Geolocation Routing:

Geolocation routing lets you choose where your traffic will be sent based on the geographic location of your users (i.e. the location from which DNS queries originate). For example, you might want all queries from Europe to be routed to a fleet of EC2 instances that are specifically configured for your European customers. These servers may have the local language of your European customers and all prices are displayed in Euros.

#### DNS Exam Tips
- ELB's do not have pre-defined IPv4 addresses, you resolve to them using a DNS name.
- Understand the difference between an Alias Record and a CNAME.
- Given the choice, always choose an Alias Record over a CNAME.
- Remember the different routing policies and their use cases.
  - Simple
  - Weighted
  - Latency
  - Failover
  - Geolocation


Week 5 
---

### Databases 101
What is a relational database? Relational databases are what most of us are all used to. They have been around since the 70's. Think of a traditional spreadsheet.

- Database
- Tables
- Row
- Fields (Columns)

#### Relational Database Types

- SQL Server (Microsoft)
- Oracle
- MySQL (Open Source)
- PostgreSQL (Open Source)
- Aurora (Amazon)
- MariaDB

#### Non Relational Databases

- Database
  - Collection      = Table
  - Document        = Row
  - Key Value Pairs = Fields

- NoSQL

#### What is Data Warehousing? 

Used for business intelligence. Tools like Cognos, Jaspersoft, SQL Server Reporting Services, Oracle Hyperion, SAP NetWeaver.

Used to pull in very large and complex data set. Usually used by management to do queries on data (such as current performance vs target etc.)

#### OLTP vs OLAP

Online Transaction Processing (OLTP) differs from Online Analytics Processing (OLAP) in terms of the types of queries you will run.

__OLTP Example:__

Order number 2120121

Pulls up a row of data such as Name, Date, Address to Deliver to, Delivery Status etc.


__OLAP Example:__

Net Profit for EMEA and Pacific for the Digital Radio Product. Pulls in large number of records.

Sum of Radios Sold in EMEA

Sum of Radios Sold in Pacific

Unit Cost of Radio in each region

Sales price of each radio

Sales price - unit cost.

Data Warehousing databases use different type of architecture both from a database perspective and infrastructure layer.

#### ElastiCache?
ElastiCache is a web service that makes it easy to deploy, operate, and scale an in-memory cache in the cloud. The service improves the performance of web applications by allowing you to retrieve information from fast, managed, in-memory caches, instead of relying entirely on slower disk-based databases.

ElastiCache supports two open-source in-memory caching engines:
- Memcached
- Redis

#### AWS Database Types - Summary
- RDS - OLTP
  - SQL Server
  - Oracle
  - MySQL
  - PostgreSQL
  - Aurora
  - MariaDB
- DynamoDB - No SQL
- RedShift - OLAP - DataWarehouse
- ElastiCache - In Memory Caching

#### Launching an RDS Instance - Lab
- Go to Amazon RDS
- Select create RDS instance
- Select MySQL 
- Leave all the setting as default
- Under DB instance identifier put `myRDSinstance`. This is the actual name of the instance.
- Then put in a username name and password of your choosing. This is used to actually connect to the database.
- Leave the Network and Security settings default except create a new VPC security group and under database option put in a name for the Database.
- Launch the instance. This can take a while depending on the size of the instance.
- Launch a new EC2 instance. Put in the following bootstrap script to be run at startup.
  ```
  #!/bin/bash
  yum install httpd php php-mysql -y
  yum update -y
  chkconfig httpd on
  service httpd start
  echo "<?php phpinfo();?>" > /var/www/html/index.php
  cd /var/www/html
  wget https://s3.eu-west-2.amazonaws.com/my-s3-bucket-name/connect.php
  ```

  - In put `connect.php` in an S3 instance and put the following code in it:
  ```
  <?php
    $username = "myUsername";
    $password = "myPassword";
    $hostname = "youhostnameaddress";
    $dbname = "myDBname";

    //connection to the database
    $dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL"); 
    echo "Connected to MySQL using username - $username, password - $password, host - $hostname<br>"; 
    $selected = mysql_select_db("$dbname",$dbhandle) or die("Unable to connect to MySQL DB - check the database name and try again."); 
  ?>
  ```
- Go into the EC2 instance and put the RDS endpoint URL into the `hostname` variable in the above code.
- Going to `myEC2instnanceIP/connect.php` should display the php info in your web browser.
- Add MYSQL/Aurora to the EC2 instance security group.

### RDZ - Back Ups, Multi-AZ & Read Replicas

There are two different types of Backups for AWS: Automated Backups and Database Snapshots.

__Automated Backups__

Automated Backups allow you to recover your database to any point in time within a "retention period". The retention period can be between one and 35 days. Automated Backups will take a full daily snapshot and will also store transaction logs throughout the day. When you do a recovery, AWS will first choose the most recent daily back up, and then apply transaction logs relevant to that day. This allows you to do a point in time recovery down to a second, within the retention period.

Automated Backups are enabled by default. The backup data is stored in S3 and you get free storage space equal to the size of your database. So if you have an RDS instance of 10Gb, you will get 10Gb worth of S3 backup storage.

Backups are taken within a defined window. During the backup window, storage I/O may be suspended while you data is being backed up and you may experience elevated latency.


__Snapshots__

DB Snapshots are done manually (i.e. they are user initiated.) They are stored even after you delete the original RDS instance, unlike automated backups.

##### Restoring Backups

Whenever you restore either an Automatic Backup or a manual Snapshot, the restored version of the database will be a new RDS instance with a new DNS endpoint.

##### Encryption

Encryption at rest is supported for MYSQL, Oracle, SQL Server, PostgreSQL, MariaDB, and Aurora. Encryption is done using the AWS Key Management Service (KMS) service. Once you RDS instance is encrypted, the data stored at rest in the underlying storage is encrypted, as are its automated backups, read replicas, and snapshots. At the present time, encrypting an existing DB Instance is not supported. To use Amazon RDS encryption for an existing database, you must first create a snapshot, make a copy of that snapshot and encrypt the copy.

### Multi-AZ RDS

Multi-AZ allows you to have an exact copy of your production database in another Availability Zone. AWS handles the replication for you, so when your production database is written to, this write will automatically be synchronized to the stand-by database.

In the event of planned database maintenance, DB Instance failure, or an Availability Zone failure, Amazon RDS will automatically failover to the standby so that database operations can resume quickly without administrative intervention.

__Disaster Recovery__

Multi-AZ is for disaster recovery only. It is not primarily used for improving performance. For performance improvement, you need Read Replicas.

### Read Replicas

Read Replicas allow you to have a read-only copy of your production database. This is achieved by using Asynchronous replication from the primary RDS instance to the read replica. You use read replicas primarily for very read-heavy database workloads.

- Used for scaling, __not__ for disaster recovery!
- Must have automatic backups turned on in order to deploy a read replica.
- You can have up to 5 read replica copies of any database.
- Each read replica will have its own DNS endpoint.
- You __can__ have read replicas that have Multi-AZ.
- You __can__ create read replicas of Multi-AZ source databases.
- Read replicas can be promoted to be their own databases. This breaks the replication.
- You can have a read replica in a second region.

### DynamoDB

Amazon DynamoDB is a fast and flexible NoSQL database service for all applications that need consistent, single-digit millisecond latency at any scale. It is a fully managed database and supports both document and key-value data models. Its flexible data model and reliable performance make it a great fit for mobile, web, gaming, ad-tech, IoT, and many other applications.

- Stored on SSD storage.
- Spread Across 3 geographically distinct data centers. 
- Eventually Consistent Reads (Default)
  - Consistency across all copies of data is usually reached within a second. Repeating a read after a short time should return the updated data. (Best Read Performance)
- Strongly Consistent Reads
  - A strongly consistent read returns a result that reflects all writes that received a successful response prior to the read.

##### DynamoDB Pricing

- Provisioned Throughput Capacity
  - Write Throughput $0.0065 per hour for every 10 units.
  - Read Throughput $0.0065 per hour for every 50 units.
- Storage costs of $0.25Gb per month.

### Redshift

Amazon Redshift is a fast and powerful, fully managed, petabyte-scale data warehouse service in the cloud. Customers can start small for just $0.25 per hour with no commitments or upfront costs and scale to a petabyte or more for $1,000 per terabyte per year, less than a tenth of most other data warehousing solutions.

__OLAP transaction Example:__

Net Profit for EMEA and Pacific for the Digital Radio Product.

Pulls in large numbers of records.

- Sum of Radios Sold in EMEA
- Sum of Radios Sold in Pacific
- Unit Cost of Radio in each region
- Sales price of each radio
- Sales price - unit cost.

Data Warehousing databases use a different type of architecture both from a database perspective and infrastructure layer.

#### Redshift Configuration

- Single Node(160Gb)
- Multi-Node
  - Leader Node (manages client connections and receives queries).
  - Computer Node (store data and perform queries and computations). Can have up to 128 Compute Nodes.


#### Redshift - 10 times faster

__Columnar Data Storage:__ Instead of storing data as a series of rows, Amazon Redshift organizes the data by column. Unlike row-based systems, which are ideal for transaction processing, column-based systems are ideal for data warehousing and analytics, where queries often involve aggregates performed over large data sets. Since only the columns involved in the queries are processed and columnar data is stored sequentially on the storage media, column-based systems required far fewer I/Os, greatly improving query performance.

__Advanced Compression:__ Columnar data stores can be compressed much more than row-based data stores because similar data is stored sequentially on disk. Amazon Redshift employs multiple compression techniques and can often achieve significant compression relative to traditional relational data stores. In addition, Amazon Redshift doesn't require indexes or materialized views and so uses less space than traditional relational database systems. When loading data into an empty table, Amazon Redshift automatically samples your data and selects the most appropriate compression scheme.

__Massively Parallel Processing (MPP):__ Amazon Redshift automatically distributes data and query loads across all nodes. Amazon Redshift makes its easy to add nodes to you data warehouse and enables you to maintain fast query performance as your data warehouse grows.


#### Redshift Pricing

- Compute Node Hours (total number of hours you run across all your compute nodes for the billing period. You are billed for 1 unit per node per hour, so a 3-node data warehouse cluster running persistently for an entire month would incur 2,160 instance hours. You will node be charged for leader node hours; only compute nodes will incur charges.)

- Backups

- Data transfer (only within a VPC, not outside it)

#### Redshift Security

- Encrypted in transit using SSL
- Encrypted at rest using AES-256 encryption
- By default Redshift takes care of key management.
  - Manage your own keys through HSM
  - AWS Key Management System

#### Redshift Availability

- Currently only available in 1 AZ
- Can restore snapshots to new AZ's in the event of an outage.


### ElastiCache

ElastiCache is a web service that makes it easy to deploy, operate, and scale an in-memory cache in the cloud. The service improves the performance of web applications by allowing you to retrieve information from fast, managed, in-memory caches, instead of relying entirely on slower disk-based databases.

Amazon ElastiCache can be used to significantly improve latency and throughput for many read-heavy application workloads (such as social networking, gaming, media sharing and Q&A portals) or compute-intensive workloads (such as a recommendation engine).

Caching improves application performance by storing critical pieces of data in memory for low-latency access. Cached information may include the results of I/O-intensive database queries or the results of computationally-intensive calculations. 

#### Types of ElastiCache
- Memcached
  - A widely adopted memory object caching system. ElastiCache is protocol compliant with Memchached, so popular tools that you use today with existing Memcached environments will work seamlessly with the service.
- Redis
  - A popular open-source in-memory key-value store that supports data structures such as sorted sets and lists. ElastiCache supports Master/Slave replication and Multi-AZ which can be used to achieve cross AZ redundancy.

#### ElastiCache Exam Tips

Typically you will be given a scenario where a particular database is under a lot of stress/load. You may be asked which service you should use to alleviate this.

ElastiCache is a good choice if your database is particularly read heavy and not prone to frequent changing.

Redshift is a good answer is the reason your database is feeling stress is because management keeps running OLAP transactions on it etc.

### Aurora

Amazon Aurora is a MySQL-compatible, relational database engine that combines the speed and availability of high-end commercial databases with the simplicity and cost-effectiveness of open sources databases. Amazon Aurora provides up to five times better performance than MySQL at a price point one tenth that of a commercial database while delivering similar performance and availability.

#### Aurora Scaling

- Start with 10GB, Scales in 10GB increments to 64TB (Storage Autoscaling)
- Compute resources can scale up to 32vCPUs and 244GB of Memory.
- 2 copies of your data is contained in each availability zone, with minimum of 3 availability zones. 6 copies of your data.
- Aurora is designed to transparently handle the loss of up to two copies of data without affecting database write availability and up to three copies with affecting read availability.
- Aurora storage is also self-healing. Data blocks and disks are continuously scanned for errors and repaired automatically.

#### Aurora Replicas

- 2 type of Replicas are available.
- Aurora Replicas (currently 15).
- MySQL Read Replicas (currently 15).

### AWS Databases Summary
- Database types
  - RDS - OLTP
    - SQL 
    - MySQL
    - PostgreSQL
    - Oracle
    - Aurora
    - MariaDB
  - DynamoDB - NoSQL
  - Redshift - OLAP
  - ElastiCache - In Memory Caching
    - Memcached
    - Redis
- Multi-AZ
  - If a database in one AZ goes down, traffic is automatically routed to another specified database.
- Read Replica
  - You can create a read replica of a production database that are replicas of your main database and then distribute those around so people can read from those to help balance out the load on one database.
- Aurora Scaling
  - 2 copies of your data is contained in each availability zone, with minimum of 3 availability zones. 6 copies of your data.
  - Aurora is designed to transparently handle the loss of up to two copies of data without affecting database write availability and up to three copies with affecting read availability.
  - Aurora storage is also self-healing. Data blocks and disks are continuously scanned for errors and repaired automatically.
- Aurora Replicas
  - 2 type of Replicas are available.
    - Aurora Replicas (currently 15 maximum).
    - MySQL Read Replicas (currently 15 maximum).
- DynamoDB vs RDS
  - DynamoDB offers "push button" scaling, meaning that you can scale your database on the fly, without any downtime.
  - RDS is not so easy and you usually have to use a bigger instance size or add a read replica.
- DynamoDB
  - Stored on SSD storage
  - Spread Across 3 geographically distinct data centers
  - Eventual Consistent Reads (Default)
    - Data insert into the database is NOT available to the application in under 1ms.
  - Strongly Consistent Reads
    - Data insert into the database is available to the application in under 1ms.
- Redshift Configuration
  - Single Node (160Gb)
  - Multi-Node
    - Leader Node (manages client connections and receives queries).
    - Compute Nodes (store data and perform queries and computations). Up to 128 Compute Nodes.
- ElastiCache
  - ElastiCache is a webservice that makes it easy to deploy, operate, and scale an in-memory cache in the cloud. The service improves the performance of web applications by allowing you to retrieve information from fast, managed, in-memory caches, instead of relying entirely on slower disk-based databases. ElastiCache supports two open-source in-memory caching engines.
    - Memcached
    - Redis

Week 6 
---

### VPC Overview - _This is one of the most important topic for the Exam_

Think of a VPC as a virtual data center in the cloud.

__AWS Definition__ - Amazon Virtual Private cloud (Amazon VPC) lets you provision a logically isolated section of the Amazon Web Services (AWS) Cloud where you can launch AWS resources in a virtual network that you define. You have complete control over your virtual networking environment, including selection of your own IP address range, create of subnets, and configuration of route tables and network gateways.

You can easily customize the network configuration for your Amazon Virtual Private Cloud. For example, you can create a public-facing subnet for you webservers that has access to the Internet, and place you backend systems such as databases or application servers in a private-facing subnet with no internet access. You can leverage multiple layers of security, including security groups and network access control lists, to help control access to Amazon EC2 instances in each subnet.

Additionally, you can create a Hardware Virtual Private Network (VPN) connection between your corporate datacenter and you VPC and leverage the AWS cloud as a extension of you corporate datacenter.

#### What can you do with a VPC?

- Launch instances into a subnet of your choosing
- Assign custom IP address ranges in each subnet
- Configure route tables between subnets  
- Create internet gateway and attach it to our VPC  
- Much better security control over you AWS resources
- Instance security groups
- Subnet network access control lists (ACLS)

#### Default VPC vs Custom VPC

- Default VPC is user friendly, allowing you to immediately deploy instances.
- All Subnets in default VPC have a route out to the internet
- Each EC2 instance has both a public and private IP address

#### VPC Peering

- Allows you to connect one VPC with another via a direct network route using private IP addresses.
- Instances behave as if they were on the same private network.
- You can peer VPC's wit other AWS accounts as well as with other VPCs in the same account.
- Peering is in a star configuration: i.e. 1 central VPC peers with 4 others. NO TRANSITIVE PEERING!!!

#### VPC Exam Tips

- Think of a VPC as a logical datacenter in AWS.
- Consists of IGWs (Or Virtual Private Gateways)  Route Tables, Network Access Control Lists, Subnets, and Security Groups.
- 1 Subnet = 1 Availability Zone.
- Security Groups are Stateful; Network Access Control Lists are Stateless.
- NO TRANSITIVE PEERING! Example: A = B, B = C, A != C

#### Building your own custom VPC - Lab

- Go to the VPC section on the AWS Dashboard
- Click on create VPC
- Enter a name and the IPv4 CIDR block. The biggest is 10.0.0.0/16
- Select whether or not o have an Amazon provided IPv6 CIDR block.
- Select the Tenancy. Default is shared hardware.
- _When you create a new custom VPC, you will also get a default Network ACL (Access Control List) and Security Group. You will also get a route table._
- Next go to Subnets and create a new Subnet.
- Fill in the Name tag, select the VPC you just created, and select and Availability Zone. The Availability Zone choices given correspond to random Availability Zones depending on each individual use despite having the same name. This is so that all the traffic is spread across all AZs evenly.
- Choose a IPv4 CIDR block. 10.0.1.0/24 this will give me 252 address (Only 251 are actually available).
- Choose don't assign an IPv6 CIDR block.
- Create the Subnet.
- _The first four IP addresses and the last IP address are not available for you to use as Amazon uses them the VPC router, IP of the DNS server, AWS future use, and lastly the Network broadcast address._
- Create a second Subnet for the same VPC in a different AZ and give it a 10.0.2.0/24 IPv4 CIDR block.
- Now there is nothing in the subnets yet so we need to create an Internet Gateway (IGW).
- Go to Internet Gateway, give it a name and click create.
- By default it is detached so attach it to the VPC.
- _Internet Gateways can only be attached to one VPC at a time._
- Now go to Route Tables. Two should have been created along with the VPC.
- _Every time you create a Subnet, it will be associated with you main route table._
- Create a new Route Table. Give it a name and assign it the VPC created earlier.
- Go to Routes and enable internet access. Select edit and enter 0.0.0.0/0 and make the target the Route Table ID of the new Route Table just created.  
- To add internet access for IPv6 do the same as above but enter ::/0 instead.
- Now associate a subnet to the route table.
- Select the Route Table and go to Subnet Associations. Select the first Subnet. This will be the public or internet facing subnet while the other will be private and not directly connected to the internet.
- Now go to Subnets and if you scroll all the way to the right, you should see and Auto-Assign IP address section. If this is no then we need to set it to yes so people can access the public subnet. 
- Select the first Subnet and go to Subnet Actions. 
- Select Modify auto-assign IP settings.
- Select auto-enable IPv4 IP addresses.
- Now launch a new EC2 Instance.
- For the Instance, select the custom VPC you created and the public facing Subnet. 
- Choose either the default security group or create a new one for the custom VPC.
- Allow SSH and HTTP access to the instance.
- _Security groups are specific to VPCs._
- Leave everything else as default and start up the instance.
- Create a second EC2 instance on the same VPC but choose the other non public facing Subnet.
- Use the default security group.
- Leave everything else as default and start up the instance.
- SSH into the public EC2 instance.
- If the Instances are working then go back to the AWS Console.
- Create a new Security Group.
- Give it a name and assign it to the VPC created earlier.
- Add the following Inbound rules:
  - SSH
  - MySQL/Aurora
  - HTTP
  - HTTPS
  - All ICMP
- Under Source, add the CIDR address range for the Subnets to all the Inbound rules. 10.0.1.0/24.
- Click Create.
- Assign the Security Group to both the EC2 instances.
- SSH into the public EC2 instance.
- Ping the private EC2 instance.
- Get the private key for the private EC2 instance. 
- _Never put private keys for your private servers on a public server._
- SSH from the public instance the private one.
- Try sudo yum update -y
- _You'll notice that this doesn't work because the private instance have no internet access._


### NAT Instances and Gateways

_Being replace by NAT Gateways_

- Create a new EC2 instance with a NAT AMI which can be found by searching for "nat" in community AMI's.
- Put it in a security group with SSH, HTTP, and HTTPS.
- Select the NAT instance and disable source and destination check by selecting Actions and toggling it off.
- Select your default Route Table in the VPC Dashboard.
- Add a new Route with destination 0.0.0.0/0.
- Make the Target the NAT instance.

If you go back to the private instance, you should now have internet access.

There are a lot of bottlenecks with this approach. We can fix this by using a NAT Gateway instead

- Got to NAT Gateways in the VPC Dashboard and click create.
- Put in your public subnet.
- Generate a new Elastic IP.
- Wait for it to become available.
- Go back to the public Subnet Route Table
- Under Routes remove the the 0.0.0.0/0 destination.
- Replace it with 0.0.0.0/0 and make the target the NAT Gateway.

You should now have internet access on the private subnet instance.

You are going to need a NAT Gateway in every Availability Zone.

By Default, NAT Gateways have 10Gbps bandwidth.

#### Exam Tips
- NAT Instances
  - When creating a NAT instance, Disable Source/Destination Check on the Instance.
  - NAT Instances must be in a public subnet.
  - There must ne a route out of the private subnet to the NAT instance, in order for this to work.
  - The amount of traffic that NAT instance can support depends on the instance size. If you are bottlenecking increase the instance size.
  - You can also create high availability using Autoscaling Groups, multiple subnets in different AZs, and a script to automate failover.
  - Behind a security group.

- NAT Gateways
  - Preferred by the enterprise.
  - Scale automatically up to 10Gbps
  - No need to patch.
  - Not associated with security groups.
  - Automatically assigned a public IP address.
  - Remember to update your route tables.
  - No need to disable Source/Destination Checks.
  - More secure than a NAT instance. 
    - Amazon manages it all for you.


### Network Access Control List (ACL)

Network ACLs are created automatically for Subnets.

#### Custom ACL - Lab

- Click on Create Network ACL
- Give it a name and the VPC (Can only be linked to one VPC at a time)
- Select the ACL and under Inbound Rules put HTTP, HTTPS, and SSH with rules numbers 100, 200, 300 respectively. (You should increment rules by 100 so you have "100 different way to change the rule")
- For Outbound Rules, put the same except instead of SSH put in Custom TCP with the port range 1024-65535. (For Ephemeral ports, the port range is different based on the OS)
- Associate the public Subnet with the new ACL.
- You should now be able to go to the EC2 instance on the public subnet and view a webpage hosted with apache.

#### Exam Tips

- Your VPC automatically comes with a default Network ACL, and by default it allows all Inbound and Outbound traffic.
- You can create custom Network ACLs. By default each custom Network ACL denies all Inbound and Outbound traffic until you add rules.
- Each subnet in your VPC must be associated with an ACL. If you don't explicitly associate a subnet with a Network ACL, the subnet is automatically associated with the default network ACL.
- You can associate a network ACL with multiple subnets, however a subnet can only be associated with one ACL at a time. When you associate a Network ACL with a subnet, the previous association is removed. 
- Network ACLs contain a numbered list of rules that is evaluated in order, starting with the lowest numbered rule.
- Network ACLs have separate Inbound and Outbound rules ad each rule can either allow or deny traffic. 
- Network ACLs are stateless. Responses to allowed inbound traffic are subject to the rules for Outbound traffic and vice versa.
  - This is the opposite of Security Groups
- Block IP Addresses using Network ACL, Not Security Groups.

#### Custom VPC and ELB - Lab

- Create a new Load Balancer.
- Choose the Application Load Balancer.
- Make it Internet Facing with IPv4. 
- Choose your VPC.
- Put your Load Balancer into 2 public facing subnets. This is required.

This was just a quick overview of what is required for an ELB regarding VPCs

### VPC Flow Logs

VPC Flow Logs is a feature that enables you to capture information about the IP traffic going to and from network interfaces in your VPC. Flow log data is stored using Amazon CloudWatch Logs. After you've created a flow log, you can view and retrieve its data in Amazon CloudWatch Logs.

Flow logs can be created at 3 different levels:

- VPC
- Subnet 
- Network Interface Level

To create a Flow Log, just select a VPC, under Actions select create Flow Log and configure the Filter, assign or create a IAM Role, and Create CloudWatch Log group.

You can stream the Logs to Lambda so you could have something in your environment react to something in your logs.

#### Exam Tips

- You cannot enable flow logs for VPCs that are peered with your VPC unless the peer VPC is in your account
- You cannot tag a flow log
- After you've created a flow log, you cannot change its configuration. For example, you can't associate a different IAM role with the flow log.
- Not all IP Traffic is monitored:
  - Traffic generated by instances when they contact the Amazon DNS server. If you use your own DNS server, then all traffic to that DNS server is logged.
  - Traffic generated by a Windows instance for Amazon Windows license activation.
  - Traffic to and from 169.254.169.254 for instance metadata.
  - DHCP traffic.
  - Traffic to the reserved IP address for the default VPC router.

### Nat vs Bastions

- A NAT is used to provide internet traffic to EC2 instances in private subnets.
- A Bastion instance is used to securely administer EC2 instances (using SSH or RDP) in private subnets. 

### AWS VPC - Summary 

__Learn how to make a whole VPC from memory__, This is very important for the exam.

- NAT Instances
  - When creating a NAT instance, Disable Source/Destination Check on the instances.
  - NAT instance must be in a public subnet.
  - There must be a route out of the private subnet to the NAT instance, in order for this to work.
  - The amount of traffic that NAT instances can support depends on the instance size. If you are bottlenecking, increase the instance size.
  - You can create high availability using Autoscaling Groups, multiple subnets in different AZs, and a script to automate failover. 
- NAT Gateways
  - Preferred by the enterprise.
  - Scale automatically up to 10Gbps.
  - No need to patch.
  - Not associated with security groups.
  - Automatically assigned a public IP address.
  - Remember to update your route tables.
  - No need to disable Source/Destinations Checks.
  - More secure than a NAT instance.
- Network ACLs
  - Your VPC automatically comes with a default network ACL, and by default it allows all outbound and inbound traffic.
  - You can create custom network ACLs. By default, each custom network ACL denies all inbound and outbound traffic until you add rules.
  - Each subnet in your VPC must be associated with a network ACL. If you don't explicitly associate a subnet with a network ACL, the subnet is automatically associated with the default network ACL.
  - You can associate a network ACL with multiple subnets, however, a subnet can be associated with only one network ACL at a time. When you associate a network ACL with a subnet, the previous association is removed.
  - Network ACLs contain a numbered list of rules that is evaluated in order, starting with the lowest numbered rule.
  - Network ACLs have separate inbound and outbound rules, and each rule can either allow or deny traffic. 
  - Network ACLs are stateless, responses to allowed inbound traffic are subject to the rules for outbound traffic and vice versa.
  - Can block IP Addresses using network ACLs not Security Groups.
- Application Load Balancers (ALBs)
  - You will need at least 2 public subnets in order to deploy an application load balancer.
- VPC Flow Logs
  - You cannot enable flow logs for VPCs that are peered with your VPC unless the peer VPC is in your account.
  - You cannot tag a flow log.
  - After you've created a flow log, you cannot change its configuration. For example, you can't associate a different IAM role with the flow log.     
  - Not all IP Traffic is monitored:
    - Traffic generated by instances when they contact the Amazon DNS server. If you use your own DNS server, then all traffic to that DNS server is logged.
    - Traffic generated by a Windows instance for Amazon Windows license activation.
    - Traffic to and from 169.254.169.254 for instance metadata.
    - DHCP traffic.
    - Traffic to the reserved IP address for the default VPC router.

Week 7 
---

### SQS - Simple Queue Service

Amazon SQS is a web service that gives you access to message queue that can be used to store messages while waiting for a computer to process them. Amazon SQS is a distributed queue system that enables web service applications to quickly and reliably queue messages that one component in the application generates to be consumed by another component. A queue is a temporary repository for messages that are awaiting processing.


__What is SQS?__

Using Amazon SQS, you can decouple the components of an application so they run independently, easing message management between components. Any component of a distributed application can store messages in the queue. Messages can contain up to 256 KN of text in any format. Any component can later retrieve the messages programmatically using the Amazon SQS API. The queue acts as a buffer between the component producing and saving data, and the component receiving the data for processing. This means the queue resolves issues that arise if the producer is producing work faster than the consumer can process it, or if the producer or consumer are only intermittently connected to the network.

#### Standard Queues

Amazon SQS offers standard as the default queue type. A standard queue lets you have a nearly-unlimited number of transactions per second. Standard queues guarantee that a message is delivered at least once. However occasionally (because of the highly-distributed architecture that allows high throughput), more than one copy of a message might be delivered out of order. Standard queues provide best-effort ordering which ensures that messages are generally delivered in the same order as they are sent.

#### FIFO Queues

The FIFO queue complements the standard queue. The most important features of this queue type are FIFO (first-in-first-out) delivery and exactly-once processing: The order in which messages are sent and received is strictly preserved and a message is delivered once and remains available until a consumer processes and deletes it; duplicates are not introduced into the queue. FIFO queues also support message groups that allow multiple ordered message groups within a single queue. FIFO queues are limited to 300 transactions per second (TPS), but have all the capabilities of standard queues.  


#### SQS Key Facts

- SQS is pull-based, not pushed-based.
- Messages are 256 KB in size.
- Messages can be kept in the queue from 1 minute to 14 days.
- Default retention period is 4 days.
- SQS guarantees that your messages will be processed at least once.

#### SQS Visibility Timeout
- The Visibility Timeout is the amount of time that the message is invisible in the SQS queue after a reader picks up that message. Provided the job is processed before the visibility time out expires, the message will then be deleted from the queue. If the job is not processed within that time, the message will become visible again and another reader will process it. This could result in the same message being delivered twice.
- Default Visibility Timeout is 30 seconds.
- Increase it if your task takes >30 seconds.
- Maximum is 12 hours.

#### SQS Long Polling

- Amazon SQS long polling is a way to retrieve messages from your Amazon SQS queues.
- While the regular short polling returns immediately (even if the message queue being polled is empty), long polling doesn't return a response until a message arrives in the message queue, or the long poll times out.
- As such, long polling can save money.

#### Exam Tips

- SQS is a distributed message queueing system.
- Allows you to decouple the components of an application so that they are independent.
- Pull-based, not push-based.
- Standard Queues (default) - best-effort ordering. Message delivered at least once.
- FIFO Queues (First In First Out) - ordering strictly preserved, message delivered once, no duplicates. e.g. good for banking transactions where things need to happen in a strict order.
- Visibility Timeout
  - Default is 30 seconds - increase if your task takes >30 seconds to complete.
  - Max 12 hours.
- Short Polling - returned immediately even if no messages are in the queue.
- Long Polling - polls the queue periodically and only returns a response when a message is in the queue or the timeout is reached. 

### SWF - Simple Workflow Service

Amazon Simple Workflow Service (Amazon SWF) is a web service that makes it easy to coordinate work across distributed application components. Amazon SWF enables applications for a range of use cases, including media processing, web applications back-ends, business process workflows, and analytics pipelines, to be designed as a coordination of tasks. Tasks represent invocations of various processing steps in an application which can be performed by executable code, web service calls, human actions, and scripts.

Example: 

Customer Order (Start) --> Verify Order --> Charge Credit Card --> Ship Order --> Record Completion --> End

#### SWF Workers and Deciders

##### SWF Workers

- Workers are programs that interact with Amazon SWF to get tasks, process received tasks, and return the result.

##### SWF Deciders

- The decider is a program that controls the coordination of tasks, i.e. their ordering, concurrency, and scheduling according to the application logic.

The workers and the diced can run on cloud infrastructure, such as Amazon EC2, or on machines behind firewalls. Amazon SWF brokers the interactions between workers and the decider. It allows the decider to get consistent views into the progress of tasks and to initiate new tasks in an ongoing manner.

At the same time, Amazon SWF stores tasks, assigns them to workers when they are ready, and monitors their progress. It ensures that a task is assigned only once and is never duplicated. Since Amazon SWF maintains the applications state durably, workers and deciders don't have to keep track of execution state. They can run independently, and scale quickly.


#### SWF Domains

You workflow and activity types and the workflow execution itself are all scoped to a domain. Domains isolate a set of types, execution itself are all scoped to a domain. Domains isolate a set of types, executions, and task lists from other within the same account.

You can register a domain by using the AWS Management Console or by using the RegisterDomain action in the Amazon SWF API.

The parameters are specified in JavaScript Object Notation (JSON) format.

```
https://swf.us-west-1.amazonaws.com
RegisterDomain
{
  "name" : "835632195",
  "description" : "music",
  "workflowExecutionRetentionPeriodInDays" : "60"
}
```
Maximum Workflow can be 1 year and the value is always measured in seconds.

### SWF vs SQS

- Amazon SWF presents a task-oriented API, whereas Amazon SQS offers a message-oriented API.
- Amazon SWF ensures that a task is assigned only once and is never duplicated. With Amazon SQS, you need to handle duplicate messages and may also need to ensure that a message is processed only once.
- Amazon SWF keeps track o fall the tasks and events in an application. With Amazon SQS, you need to implement your own application-level tracking, especially if your application uses multiple queues.

### SNS - Simple Notification Service 

Amazon Simple Notification Service (Amazon SNS) is a web service that makes it easy to setup, operate, and send notifications from the cloud. It provides developers with a highly scalable, flexible, and cost-effective capability to publish messages from an application and immediately deliver them to subscribers or other applications. 

Push notifications to Apple, Google, Fire OS, and Windows devices, as well as Android devices in China with Baidu Cloud Push.

Besides pushing cloud notifications directly to mobile devices, Amazon SNS can also deliver notifications by SMS text message or email, to Amazon Simple Queue Service (SQS) queues, or to any HTTP endpoint. SNS notifications can also trigger Lambda functions. When a message is published to an SNS topic that has a Lambda function subscribed to it, the Lambda function is invoked with the payload of the published message. The Lambda function receives the message payload as an input parameter and can manipulate the information in the message, publish the message to other SNS topics, or send the message to other AWS services.

SNS allows you to group multiple recipients using topics. A topic is an "access point" for allowing recipients to dynamically subscribe for identical copies of the same notification. One topic can support deliveries to multiple endpoint types -- for example, you can group together iOS, Android, and SMS recipients. When you publish once to a topic, SNS delivers appropriately formatted copies of your message to each subscriber.

To prevent messages from being lost, all messages published to Amazon SNS are stored redundantly across multiple availability zones.

#### SNS Benefits

- Instantaneous, push-based delivery (no polling).
- Simple APIs and easy integration with applications.
- Flexible message delivery over multiple transport protocols.
- Inexpensive, pay-as-you-go model with no up-front costs.
- Web-based AWS Management Console offers the simplicity of a point-and-click interface.

#### SNS vs SQS

- Both Messaging Services in AWS.
- SNS - Push
- SQS - Polls (Pulls)

#### SNS Pricing

- Users pay $0.50 per 1 million Amazon SNS Requests
- $0.06 per 100,000 Notification deliveries over HTTP
- $0.75 per 100 Notification deliveries over SMS
- $2.00 per 100,000 Notification delivers over Email

### Elastic Transcoder

- Media Transcoder in the cloud.

- Convert media files from their original source format into different formats that will play on smartphones, tablets, PC's etc.

- Provides transcoding presets for popular output formats, which means that you don't need to guess about which settings work best on particular devices.

- Pay based on the minutes that you transcode and the resolution at which you transcode.

### API Gateway

Amazon API Gateway is a fully managed service that makes it easy for developers to publish, maintain, monitor, and secure APIs at any scale. With a few clicks in the AWS Management Console, you can create an API that acts as a "front door" for applications to access data, business logic, or functionality from your back-end services, such as applications running on Amazon Elastic Compute Could (EC2), code running on AWS Lambda, or any web application.

#### API Caching

You can enable API caching in Amazon API Gateway to cache your endpoint's response. With caching, you can reduce the number of calls made to your endpoint and also improve latency of the requests to you API. When you enable caching for a stage, API Gateway caches responses from your endpoint for a specified time-to-live (TTL) period, in seconds. API Gateway then responds to the request by looking up the endpoint response from the cache instead of making a request to your endpoint.

#### API Gateway Uses

- Low cost and efficient
- Scales Effortlessly
- You can Throttle Requests to prevent attacks
- Connect to CloudWatch to log all requests

#### Same Origin Policy

In computing, the same-origin policy is an important concept in the web application security model. Under the policy, a web browser permits scripts contained in a first web page to access data in a second web page, but only if both web pages have the same origin.

#### Cross-Origin Resource Sharing (CORS)

CORS is one way the server at the other end (not the client code in the browser) can relax the same-origin policy.

Cross-origin resource sharing (CORS) is a mechanism that allows restricted resources (e.g. fonts) on a web page to be requested from another domain outside the domain from which the first resource was served.

Error - "Origin policy cannot be read at the remote resource?". You need to enable CORS on API Gateway.

### Exam Tips

- Remember what API Gateway is at a high level.
- API Gateway has caching capabilities to increase performance.
- API Gateway is low cost and scales automatically.
- You can throttle API Gateway to prevent attacks. 
- You can log results to CloudWatch.
- If you are using JavaScript/AJAX that uses multiple domains with API Gateway, ensure that you have enabled CORS on API Gateway.

### Kinesis

Amazon Kinesis is a platform on AWS to send your streaming data too. Kinesis makes it easy to load and analyze streaming data, and also providing the ability for you to build your own custom applications for your business needs.

__Streaming Data:__ Data that is generated continuously by thousands of data sources, which typically send in the data records simultaneously, and in small sizes (order of Kilobytes).
  - Purchases from online stores (like amazon.com).
  - Stock Prices
  - Game data (as the gamer plays).
  - Social network data.
  - Geospatial data (think uber.com).
  - iOT sensor data.

#### Core Kinesis Services
- Kinesis Streams
  - Kinesis Streams consists of shards:
    - 5 transactions per second for reads, up to a maximum total data read rate of 2 MB per second and up to 1,000 records per second for writes, up to a maximum total dat write rate of 1 MB per second (including partition keys).
    - The data capacity of your stream is a function of the number of shards that you specify for the stream. The total capacity of the stream is the sum of the capacities of its shards.
- Kinesis Firehose
  - No need for consumers. Just end data to Firehose and it will send it to S3. 
- Kinesis Analytics
  - Allows the running of SQL queries on Firehose and Streams data.

#### Exam Tips

- Know the difference between Kinesis Streams and Kinesis Firehose. You will be given scenario questions and you must choose the most relevant service.
- Understand what Kinesis Analytics is.

### Application Summary
- SQS 
  - Amazon SQS is a web service that gives you access to a message queue that can be used to store messages while waiting for a computer to process them.
  - Always PULL based. NOT PUSH based.
  - Messages are 256KB in size.
  - Messages can be kept in the queue from 1 minute to 14 days. The default is 4 days.
  - Visibility Time Out is the amount of time that the message is invisible in the SQS queue after a reader picks up that message. Provided the job is processed before the visibility time out expires, the message will then be deleted from the queue. If the job is not processed within that time, the message will become visible again and another reader will process it. This could result in the same message being delivered twice.
  - Visibility time out maximum is 12 hours. 
  - SQS guarantees that you messages will be processed at least once.
  - Amazon SQS long polling is a way to retrieve messages from your Amazon SQS queues. While the regular short polling returns immediately, even if the message queue being polled is empty, long polling doesn't return a response until a message arrives in the message queue, or the long poll times out.
  - Queues can either be standard or FIFO.
    - Standard there is no guarantee that the messages will be processed in order.
- SWF vs SQS
  - SQS has a retention period of 14 days, SWF up to 1 year for workflow executions.
  - Amazon SWF presents a task-oriented API, whereas Amazon SQS offers a message-oriented API.
  - Amazon SWF ensures that a task is assigned only once and is never duplicated. With Amazon SQS, you need to handle duplicated messages and may also need to ensure that a message is processed only once.
  - Amazon SWF keeps track of all the tasks and events in an application. With Amazon SQS, you need to implement your own application-level tracking, especially if your application uses multiple queues.
- SWF Actors
  - Workflow Starter - An application that can initiate (start) a workflow. Could be your e-commerce website when placing an order or a mobile app searching for bus times.
  - Deciders - Control the flow of activity tasks in a workflow execution. If something has finished in a workflow (or fails) a Decider decides what to do next.
  - Activity Worker - Carry out the activity task. Could be humans, doesn't need to be AWS.
- SNS Subscribers
  - HTTP
  - HTTPS
  - Email
  - Email-JSON
  - SQS
  - Application
  - Lambda
- SNS vs SQS
  - Both Messaging Services in AWS
  - SNS - PUSH (Messages sent out to your email or phone etc.)
  - SQS - Polls (Pulls, need something like and EC2 instance pulling out messages from the queue.)
- Elastic Transcoder
  - Media Transcoder in the cloud.
  - Convert media files form their original source format into different formats that will play on smartphones, tablets, PC's etc. Provides transcoding presets for popular output formats, which means that you don't need to guess about which settings work best on particular devices. 
  - Pay based on the minutes that you transcode and the resolution at which you transcode.
- Core Kinesis Services 
  - Kinesis Streams
  - Kinesis Firehose
  - Kinesis Analytics  
- Kinesis Exam Tips
  - Know the difference between Kinesis Streams and Kinesis Firehose. You will be given questions and you must choose the most relevant service.
  - Understand what Kinesis Analytics is.

Week 8 
---
## Building a fault tolerant Wordpress site:

### Getting Setup
- Setup two new security groups.
  - WebDMZ with Outbound Rules HTTP and SSH and Source 0.0.0.0/0
  - RSSSG with Outbound Rules MySQL and Source WebDMZ 
- Provision a new RDS Instance
  - MySQL
  - T2 Micro
  - Multi AZ
  - Default VPC
  - No Public Accessibility
  - RDSSG VPC Security Group
  - _Leave rest as default_
- Create two new S3 Buckets
  - One for the Wordpress code and one for media and assets
  - _Leave the settings as default_
- Create a new CloudFront distribution
  - Web delivery method
  - Make the media and assets S3 bucket the Origin Domain Name
  - Restrict Bucket Access
  - Create new Origin Access Identity
  - Grant Read Permissions on Bucket
  - _Leave rest as default_ 
- Route 53 _Optional_
  - Register a domain name
- Create new AIM Role 
  - Choose EC2 for the Trusted Entity
  - Attach S3FullAccess Policy
- Create a new EC2 Instance
  - Amazon Linux 2 AMI
  - t2 Micro
  - IAM role is the new AIM role previously created
  - Under Advanced Details, Include the following bootstrap script to setup bootstrap:
    ```
    #!/bin/bash
    yum install httpd php php-mysql -y
    cd /var/www/html
    echo "healthy" > healthy.html
    wget https://wordpress.org/latest.tar.gz
    tar -xzf latest.tar.gz
    cp -r wordpress/* /var/www/html/
    rm -rf wordpress
    rm -rf latest.tar.gz
    chmod -R 755 wp-content
    chown -R apache:apache wp-content
    wget https://s3.amazonaws.com/bucketforwordpresslab-donotdelete/htaccess.txt
    mv htaccess.txt .htaccess
    chkconfig httpd on
    ```
  - Use the Web DMZ Security Group
  - _Leave rest as default_

### Setting up EC2
- ssh into the new EC2 instance and check that all the Wordpress files were downloaded into /var/www/html
- Start Apache with `sudo service httpd start`
- Verify that the RDS data base has started.
- Go to the URL/DNS of the EC2 instance and start setting up Wordpress.
- Connect to the database with the username, password and RDS endpoint.
- Follow the rest of the instructions and copy the code into the wp-config.php.
- Run the installation
- Create a simple post with a few images on the Wordpress site.
- If you go into the Wordpress files on the EC2 instance you should be able to find the images stored there.
- Now we need to copy the media assets up to the S3 bucket.
- Copy the media assets with to the S3 bucket with `sudo aws s3 cp --recursive /var/www/html/wp-content/upload s3://NAME-Of-S3-ASSET-BUCKET`  
- Also make a backup copy of the whole Wordpress site to the S3 code bucket with `sudo aws s3 cp --recursive /var/www/html/ s3://NAME-Of-S3-CODE-BUCKET`
- Replace the CloudFront URL in the .htaccess file in Wordpress to be your CloudFront URL and allow assets to be retrieved via CloudFront and not the Wordpress site directly
- Now sync the Wordpress site to the S3 bucket with `sudo aws s3 sync /var/www/html/ s3://NAME-Of-S3-CODE-BUCKET`
  - This will copy any files that have changed since the last copy to S3.
- In the httpd.conf file in apache, change the AllowOverride tag to All to allow apache to do URL rewrites and pull assets from CloudFront.
  - Now if you open an image in the browser, you should have a CloudFront URL.
- Create a new Load Balancer
  - Internet-facing
  - IPv4
  - All AZ's
  - WebDMZ Security Group
  - Health check path `/healthy.html` (Specified in bootstrap script)
  - Choose the target as the EC2 instance
  - Click Create

### Autoscaling and Testing

- Setup a cron task to run `root aws s3 sync --delete s3://NAME-Of-S3-CODE-BUCKET /var/www/html`
  - This will download all code from the site to the bucket.
  - You can do the same thing with the media assets.
- Create a new image of the EC2 instance to be the original standard image for the website.
- add another cron task to run `root aws s3 sync --delete /var/www/html/wp-content-uploads s3://NAME-Of-S3-ASSET-BUCKET`
- Create a new Instance and Autoscaling group.
  - Default VPC
  - All subnets
  - Receive traffic from WP instances Load balancer
  - Keep group at initial size.

### CloudFormation

- Start by deleting all the stuff that has been previously.
- Under management tools go to cloud formation.
- Create a stack.
- Select the Wordpress template 
- Use the default s3 url.
- Fill out the parameters.
  - Select the default VPC and all the different subnets already created.
- Leave the next sections blank or with default values.
- Change the security group for this and the ELB to allow HTTP access to all IPs
- Now you can delete the stack and it will delete all resources that were created along with it. 

##### If you want to be a solutions architect, then you need to know cloud formation

Week 9
---

### Architecting for the cloud: Best Practices whitepaper

- Business Benefits of the Cloud
  - Almost zero upfront infrastructure investment
  - Just-in-time Infrastructure
  - More efficient resource utilization 
  - Usage-based costing
  - Reduced time to market
- Technical Benefits of the Cloud
  - Automation - "Scriptable infrastructure"
  - Auto-scaling
  - Proactive Scaling
  - More Efficient Development lifecycle
  - Improved Testability
  - Disaster Recovery and Business Continuity
  - "Overflow" the traffic to the cloud

#### Design For Failure

Rule of thumb: Be a pessimist when designing architectures in the cloud; assume things will fail. In other words, always design, implement and deploy for automated recovery from failure. In particular, assume that your hardware will fail. Assume that outages will occur. Assume that some disaster will strike your application. Assume that you will be slammed with a more than expected number of requests per second some day. Assume that with time your application software will fail too. By being a pessimist, you end up thinking about recovery strategies during design time, which helps in designing a better overall system.

#### Decouple Your Components

The key is to build components that do not have tight dependencies on each other, so that if one component were to die (fail), sleep (not respond), or remain busy (slow to respond) for some reason, the other components in the system are built so as to continue to work as if no failure is happening. In essence, loose coupling isolates the various layers and components of your application so that each component interacts asynchronously with the others and treats them as a "black box".


For example, in the case of web application architecture, you can isolate the app server from the web server and from the database. The app server does not know about your web server and vice versa, this gives decoupling between these layers and there are no dependencies code-wise or functional perspectives. In the case of batch-processing architecture, you can create asynchronous components that are independent of each other.

#### Implement Elasticity

The cloud brings new concepts of elasticity in your applications. Elasticity can be implemented in three ways:
- Proactive Cyclic Scaling: Periodic scaling that occurs at fixed intervals (daily, weekly, monthly, quarterly).
- Proactive Event-based Scaling: Scaling just when your are expecting a big surge of traffic requests due to a scheduled business event (new product launch, marketing campaigns)
- Auto-scaling based on demand. By using a monitoring service, your system can send triggers to take appropriate actions so that it scales up or down based on metrics (utilization of the servers or network i/o, for instance)



Week 10 
---

I have completed all my work and spent the week reading suggested white papers for AWS related things as well as studied my notes.

