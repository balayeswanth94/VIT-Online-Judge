#include<iostream>
#include<stdio.h>

using namespace std;
int arr[1000000]={0};
int coin(int n)
{
	if(n==0)
		return 0;
	else if(n<12)
		return n;
	if(n<1000000)
	{
		if(arr[n]>0)
			return arr[n];
	}
		int res = max(n,coin(n/2)+coin(n/3)+coin(n/4));
		if(n<1000000) 
			arr[n]=res;
		return res;
}
int main()
{
	int n,res;
	while(scanf("%d",&n)!=EOF) 
	{
		res = coin(n);
		printf("%d\n",res);
	}
	return 0;
}