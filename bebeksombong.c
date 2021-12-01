#include <stdio.h>
int main ()
{
  int N, dt, baru;
  scanf("%d", &N);
  scanf("%d", &dt);
  printf("%d", dt);
  baru=dt;
  for (int i = 2; i <= N; i++)
  {
    scanf("%d", &dt);
      if (dt>baru)
      {
          baru=dt;
          printf(" %d", baru);
      }
      
  }
  printf("\n");
  return 0;
}